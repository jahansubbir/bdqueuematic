<?php

namespace App\Http\Controllers;

use App\BusinessLogics\LeastConnectionsAlgorithm;
use App\BusinessLogics\TokenManager;
use App\Http\Controllers\Controller;
use App\Models\TokenDetails;
use Carbon\Traits\ToStringFormat;
use DateInterval;
use Illuminate\Support\Facades\Auth;
use App\Models\Booth;
use App\Models\BoothType;
use App\Models\Counter;
use App\Models\Token;
use App\Models\TokenType;
use App\Providers\RouteServiceProvider;
use Illuminate\Routing\RedirectController;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DateTime;

class TokenController extends Controller
{
    private $leastConnectionsAlgorithm;
    public function __construct()
    {

        //$this->leastConnectionsAlgorithm = $tokenAlgorithm;
        //  $this->leastConnectionsAlgorithm = $leastConnectionsAlgorithm;
    }
    //
    public function index()
    {
        $user = Auth::user();

        $commonQuery = DB::table('tokens')
            ->join('counters', 'tokens.counter_id', '=', 'counters.id')
            ->join('token_types', 'tokens.token_type_id', '=', 'token_types.id')
            ->whereDate('appointment_start', '=', today())
            ->select(
                'tokens.id',
                'tokens.token_no',
                'tokens.appointment_start',
                'tokens.appointment_end',
                'counters.name as counter',
                'token_types.name as token_type'
            );
        
        if ($user->hasRole('admin') || $user->hasRole('operator')) {
            $resource = $commonQuery->get();
        } else {
            $resource = $commonQuery
                ->where('tokens.user_id', '=', $user->id)
                ->get();
        }
        
        return view('tokens.index', ['resource' => $resource]);
        
       
    }



    public function isCounterOperating(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->input('counter_id');
            $counter = Counter::find($id);
            $now = new DateTime();

            return $counter;
        }
    }

    public function create(string $errorMessage = null)
    {
        $counters = Counter::all();
        //$boothTypes = BoothType::all();
        //$booths = Booth::all();
        $tokenTypes = TokenType::all();

        return view('tokens.create', compact('counters', 'tokenTypes', 'errorMessage'));
    }

    public function edit(int $id)
    {
        $resource = Booth::find($id);
        $counters = Counter::all();
        $boothTypes = BoothType::all();
        return view('booths.edit', ['resource' => $resource], compact('counters', 'boothTypes'));
    }

    public function store(Request $request): RedirectResponse
    {
        date_default_timezone_set('Asia/Dhaka');
        //Data Validation
        $request->validate(
            [
                'counter_id' => 'required|integer',
                'token_type_id' => 'required|integer'
            ]
        );


        #region WINDOW ASSIGNMENT
        $user = Auth::user();
        $counter = Counter::find((int) $request->input('counter_id'));

        $numberOfBl = count($request->be_no);
        #region Arrangement

        $tokenType = TokenType::find($request->input('token_type_id'));
        $processDuration = $tokenType->process_duration;

        $booths = Booth::where([
            ['counter_id', '=', $request->input('counter_id')],
            ['booth_type_id', '=', $request->input('token_type_id')],
        ])->get();
        #endregion

        // ConnectionCount
        $connectionsCount = $this->fetchConnectionsCount($request, $tokenType);

        // Least Connection Region
        $leastConnectionsBooth = $this->findLeastConnectionsBooth($booths, $connectionsCount);

        $tokenCount = 0;
        foreach ($connectionsCount as $c) {
            $tokenCount += $c; //[$boothTypeId];
        }

        $boothId = $leastConnectionsBooth->id;
        $today = Carbon::today();
        $boothsLastToken = Token::whereDate('appointment_start', '=', $today)
            ->where(
                'booth_id',
                $boothId
            )
            ->latest('appointment_start')
            ->first();

        #region setToken


        $now = new DateTime();

        $today->setTime(
            $counter->opening_hour->hour,
            $counter->opening_hour->minute
        );
        $appointmentStart = $today;


        $appointmentEnd = $today;

        if ($boothsLastToken != null) {
            $appointmentStart = $boothsLastToken->appointment_end;

        }
        if ($now > $appointmentStart) {
            $appointmentStart = $now->add(new DateInterval('PT' . 5 . 'M'));
        }
        if($appointmentStart>=$counter->lunch_start &&
        $appointmentStart<=$counter->lunch_end
        ){
            $appointmentStart=$counter->lunch_end;
        }
        if($appointmentStart>$counter->closing_hour){
            return redirect(action([TokenController::class, 'create']))->withErrors(['error' => "Sorry! No more slot is opened for today! Please try again tormorrow."]);
        }

        //$process_duration=$tokenType->process_duration;
        $appointmentEnd = clone $appointmentStart;
        if ($tokenType->is_bulk_processable) {
            $appointmentEnd->add((new DateInterval('PT' . ($processDuration->format('i')) . 'M')));

        } else {

            $appointmentEnd->add((new DateInterval('PT' . ($processDuration->format('i') * $numberOfBl) . 'M')));
        }
        #endregion
        //new DateTime($appointmentStart)->addMinute($pDuration->format('i'));

        #region REDUNDANCY CHECK
        $is_reduntantRequest = $this->redundancyCheck($request);

        if ($is_reduntantRequest) {
            return redirect(action([TokenController::class, 'create']))->withErrors(['error' => "One or more BL/BE number cannot be used for next 2 hours"]);
        }

        #endregion

        #region dataStorage
       return $this->transactDataToDatabase($request, $boothId, $appointmentStart, $appointmentEnd, $tokenType, $tokenCount, $user);

        #endregion

     
    }

    private function transactDataToDatabase($request, $boothId, $appointmentStart, $appointmentEnd, $tokenType, $tokenCount, $user)
    {
        DB::beginTransaction();
        try {
            $token = Token::create([
                'counter_id' => $request->counter_id,
                'booth_id' => $boothId,
                'appointment_start' => $appointmentStart,
                'appointment_end' => $appointmentEnd,
                'token_type_id' => $request->input('token_type_id'),
                'token_no' => sprintf('%s%02d', $tokenType->id, $tokenCount + 1),
        
                // 'scv_code' => $user->scv_code,
                'user_id' => $user->id
        
        
        
                //'booth_type_id' => $request->booth_type_id
            ]);
            $token->save();
            // Extract the 'be_no' and 'bl_no' arrays from the request
            $beNos = $request->be_no;
            $blNos = $request->bl_no;
        
            // Create an array to store token details data
            $tokenDetailsData = [];
        
            // Populate the token details data array
            for ($i = 0; $i < count($beNos); $i++) {
                $tokenDetailsData[] = [
                    'token_id' => $token->id,
                    'be_no' => $beNos[$i],
                    'bl_no' => $blNos[$i],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Use createMany to insert multiple records at once
            $tokenDetails = TokenDetails::insert($tokenDetailsData);
            //  $tokenDetails->save();

            DB::commit();
            return 
            redirect()
            ->action([TokenController::class, 'details'], [
                'id' 
                => $token->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
           return redirect(action([TokenController::class, 'create']))
           ->withErrors(['error' => "An internal error has occurred. please try again later."]);
        }

        #endregion

     
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $validatedData = $request->validate(
            [
                'counter_id' => 'required|integer',
                'booth_no' => 'required|integer',
                'booth_type_id' => 'required|integer'
            ]
        );

        $resource = Booth::find((int) $id);


        $resource->update($validatedData);
        //event(new Counter($counter));

        //  Auth::login($user);

        return redirect(RouteServiceProvider::BOOTH);
    }
    public function details(int $id)
    {
        $user = Auth::user();
        $isAdminOrOperator = $user->hasRole('admin') || $user->hasRole('operator');
        
        $query = DB::table('tokens')
            ->join('counters', 'tokens.counter_id', '=', 'counters.id')
            ->join('token_types', 'tokens.token_type_id', '=', 'token_types.id')
            ->join('token_details', 'tokens.id', '=', 'token_details.token_id')
            ->join('users', 'tokens.user_id', '=', 'users.id')
            ->where('tokens.id', $id);
        
        if (!$isAdminOrOperator) {
            $query->where('tokens.user_id', $user->id);
        }
        
        $resource = $query->select(
            'tokens.id',
            'tokens.token_no',
            'tokens.appointment_start',
            'tokens.appointment_end',
            'counters.name as counter',
            'token_types.name as token_type',
            'token_details.be_no',
            'token_details.bl_no',
            'users.name',
            'users.cnf_name',
            'users.contact_no'
        )->get();
        
        if ($resource->isEmpty()) {
            return view('tokens.error');
        }
        
        return view('tokens.details', ['resource' => $resource]);
        
    }



    //extracted function
    private function fetchConnectionsCount(Request $request, TokenType $tokenType)
    {
        return DB::table('tokens')
            ->whereDate('appointment_start', Carbon::today())
            ->where([
                    ['counter_id', '=', $request->input('counter_id')],
                    ['token_type_id', '=', $tokenType->id],
                ])
            ->groupBy('booth_id')
            ->selectRaw('booth_id, count(*) as count')
            ->pluck('count', 'booth_id')
            ->toArray();
    }


    private function findLeastConnectionsBooth($booths, $connectionsCount)
    {
        $leastConnectionsBooth = null;
        $minConnections = PHP_INT_MAX;

        foreach ($booths as $booth) {
            $boothTypeId = $booth->id;
            $connections = isset($connectionsCount[$boothTypeId]) ? $connectionsCount[$boothTypeId] : 0;

            if ($connections < $minConnections) {
                $minConnections = $connections;
                $leastConnectionsBooth = $booth;
            }
        }

        return $leastConnectionsBooth;
    }
    private function redundancyCheck(Request $request)
    {
        $redundant = false;

        $minutesDifference = 120;

        $existingCount = DB::table('tokens')
            ->join('token_details', 'tokens.id', '=', 'token_details.token_id')
            ->whereIn('be_no', $request->be_no)
            ->orWhereIn('bl_no', $request->bl_no)
            ->whereRaw('TIMESTAMPDIFF(MINUTE, tokens.created_at, NOW()) < ?', [$minutesDifference])
            ->count();

        if ($existingCount > 0) {
            $redundant = true;

        }
        return $redundant;
    }
}