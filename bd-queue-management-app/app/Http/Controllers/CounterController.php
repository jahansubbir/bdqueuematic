<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use App\Providers\RouteServiceProvider;

class CounterController extends Controller
{
    public function index()
    {
        $counters = Counter::all();
        return view('counters.index', compact('counters'));
    }

    public function create()
    {
        return view('counters.create');
    }

    public function edit(int $id)
    {
        $resource = Counter::find($id);
        return view('counters.edit',['resource'=>$resource]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'opening_hour'=>'required',
            'lunch_start' => 'required',
            'lunch_end' => 'required',
            'closing_hour'=>'required'
            ]
        );

        $counter = Counter::create([
            'name' => $request->name,
            'lunch_start' => $request->lunch_start,
            'lunch_end' => $request->lunch_end,
            'opening_hour'=>$request->opening_hour,
            'closing_hour'=>$request->closing_hour
            
        ]);
        $counter->save();
        //event(new Counter($counter));

        //  Auth::login($user);

        return redirect(RouteServiceProvider::COUNTER);
    }

    public function update(Request $request,$id): RedirectResponse
    {
       $validatedData= $request->validate([
            'name' => 'required|string|max:255',
            'opening_hour'=>'required',
            'lunch_start' => 'required',
            'lunch_end' => 'required',
            'closing_hour'=>'required']
        );

        $resource=Counter::find((int)$id);

        
        $resource->update($validatedData);
        //event(new Counter($counter));

        //  Auth::login($user);

        return redirect(RouteServiceProvider::COUNTER);
    }
}