<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use illuminate\Support\Facades\DB;
use DateTime;

class ExportToken implements FromQuery, WithHeadings
{
    protected DateTime $fromDate;
    protected DateTime $toDate;
    //protected $toDate;
    /**
     * @return \Illuminate\Support\Collection
     */

    public function __construct($fromDate, $toDate)
    {
        $this->fromDate = new DateTime($fromDate);
        $this->toDate = new DateTime($toDate);

    }
    public function query()
    {

        $resource =

            DB::table('tokens')
                ->join('counters', 'tokens.counter_id', '=', 'counters.id')
                ->join('token_types', 'tokens.token_type_id', '=', 'token_types.id')
                ->join('token_details', 'tokens.id', '=', 'token_details.token_id')
                ->join('users','tokens.user_id','=','users.id')
                ->whereBetween('appointment_start', [$this->fromDate, $this->toDate])
                ->select(
                    'tokens.id',
                    'users.name',
                    'users.cnf_name',
                    'users.ain_no',
                    'users.contact_no',
                    
                    'counters.name as counter',
                    'token_types.name as token_type',
                    'tokens.token_no',
                  
                    
                    'tokens.appointment_start',
                   // 'tokens.appointment_end',
                    
                    
                    'token_details.be_no',
                    'token_details.bl_no'
                )->orderBy('tokens.appointment_start');

        return $resource;
    }
    public function headings():array
    {
        return [
            'ID',
            'USER',
            'CNF',
            'AIN NUMBER',
            'CONTACT NUMBER',
            'COUNTER',
            'SERVICE TYPE',
            'TOKEN NUMBER',
            'TOKEN START TIME',
            'BL NUMBER',
            'BE NUMBER'

        ];
    }
}
