<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class AdminDashboardController extends Controller
{
    //

    public function index()
    {
        $user = Auth::user();

        $resource = DB::table('tokens')
            ->join('counters', 'tokens.counter_id', '=', 'counters.id')
            ->join('token_types', 'tokens.token_type_id', '=', 'token_types.id')
          //  ->join('token_details','tokens.id','=','token_details.token_id')
            ->whereDate('appointment_start','=',today())
            ->select(
                'tokens.id',
                'tokens.token_no',
                'tokens.appointment_start',
                'tokens.appointment_end',
                'counters.name as counter',
                'token_types.name as token_type',
            //    'token_details.be_no',
            //   'token_details.bl_no'
            )->get();
            

            return view('tokens.index', ['resource' => $resource]);
      
    }
}
