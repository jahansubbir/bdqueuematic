<?php

namespace App\BusinessLogics;

use App\Models\Booth;
use App\Models\Token;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LeastConnectionsAlgorithm
{
    public  function getLeastLoadedBooth(Request $request)
    {
        // Fetch all booths
        $booths = Booth::all();

        // Fetch the total number of connections for each booth
        $connectionsCount = Token::where([
            ['created_at', Carbon::now()->today()],
            ['counter_id', '=',$request->input('counter_id')],
            ['token_type_id', '=', $request->input('token_type_id')],
        ])->get()::groupBy('booth_type_id')->selectRaw('booth_type_id, count(*) as count')->pluck('count', 'booth_type_id')->toArray();

        // Find the booth with the least connections
        $leastConnectionsBooth = null;
        $minConnections = PHP_INT_MAX;

        foreach ($booths as $booth) {
            $boothTypeId = $booth->booth_type_id;
            $connections = isset($connectionsCount[$boothTypeId]) ? $connectionsCount[$boothTypeId] : 0;

            if ($connections < $minConnections) {
                $minConnections = $connections;
                $leastConnectionsBooth = $booth;
            }
        }

        return $leastConnectionsBooth;
    }
}

// Example usage:
// $leastLoadedBooth = LeastConnectionsAlgorithm::getLeastLoadedBooth();

// if ($leastLoadedBooth) {
//     echo "Least Loaded Booth: {$leastLoadedBooth->booth_no}\n";
// } else {
//     echo "No booths available\n";
// }
