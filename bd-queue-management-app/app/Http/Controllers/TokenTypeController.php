<?php

namespace App\Http\Controllers;

use App\Models\TokenType;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\Counter;
use App\Models\BoothType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class TokenTypeController extends Controller
{
    //
    public function index()
    {
        $tokenTypes = TokenType::all();
        return view('tokenTypes.index', compact('tokenTypes'));

    }

    public function create()
    {
        // $counters = Counter::all();
        // $boothTypes = BoothType::all();

        return view('tokenTypes.create');
    }

    public function edit(int $id)
    {
        $resource = TokenType::find($id);

        return view('tokenTypes.edit', ['resource' => $resource]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'name' => 'required|string',
                'process_duration' => 'required',
                'is_bulk_processable' => 'sometimes|boolean'
            ]
        );

       $bulkProcessable = $request->has('is_bulk_processable') ? 1 : 0;
        $tokenType = TokenType::create([
            'name' => $request->name,
            'process_duration' => $request->process_duration,
            'is_bulk_processable' => $bulkProcessable//$request->is_bulk_processable

        ]);
        $tokenType->save();
        //event(new Counter($counter));

        //  Auth::login($user);

        return redirect(RouteServiceProvider::TOKEN_TYPE);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $validatedData = $request->validate(
            [
                'name' => 'required|string',
                'process_duration' => 'required',
                'is_bulk_processable' => 'boolean'
            ]
        );

        $resource = TokenType::find((int) $id);
        $validatedData['is_bulk_processable'] = $request->has('is_bulk_processable') ? 1 : 0;


        $resource->update($validatedData);
        //event(new Counter($counter));

        //  Auth::login($user);

        return redirect(RouteServiceProvider::TOKEN_TYPE);
    }
}
