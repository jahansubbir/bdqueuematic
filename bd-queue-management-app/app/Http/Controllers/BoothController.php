<?php

namespace App\Http\Controllers;

use App\Models\Booth;
use App\Models\BoothType;
use App\Models\Counter;
use App\Models\TokenType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\DB;

class BoothController extends Controller
{
    //
    public function index()
    {
       // $booths = Booth::all();
        $booths = DB::table('booths')
            ->join('counters', 'booths.counter_id', '=', 'counters.id')
            ->join('token_types','booths.booth_type_id','=','token_types.id')
            ->select('booths.id','booths.booth_no','counters.name as counter','token_types.name as type')
            ->get();
        return view('booths.index', compact('booths'));
    }

    public function create()
    {
        $counters = Counter::all();
        $boothTypes = TokenType::all();

        return view('booths.create', compact('counters', 'boothTypes'));
    }

    public function edit(int $id)
    {
        $resource = Booth::find($id);
        $counters = Counter::all();
        $boothTypes = TokenType::all();
        return view('booths.edit', ['resource' => $resource],compact('counters', 'boothTypes'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'counter_id' => 'required|integer',
                'booth_no' => 'required|integer',
                'booth_type_id' => 'required|integer'
            ]
        );

        $booth = Booth::create([
            'counter_id' => $request->counter_id,
            'booth_no' => $request->booth_no,
            'booth_type_id' => $request->booth_type_id
        ]);
        $booth->save();
        //event(new Counter($counter));

        //  Auth::login($user);

        return redirect(RouteServiceProvider::BOOTH);
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
}