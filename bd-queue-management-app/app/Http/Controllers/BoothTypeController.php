<?php

namespace App\Http\Controllers;

use App\Models\BoothType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
class BoothTypeController extends Controller
{
    //

    public function index()
    {
        $boothTypes = BoothType::all();
        return view('boothTypes.index', compact('boothTypes'));
    }

    public function create()
    {
        return view('boothTypes.create');
    }

    public function edit(int $id)
    {
        $resource = BoothType::find($id);
        return view('boothTypes.edit',['resource'=>$resource]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'type' => 'required|string|max:255'
            ]
        );

        $boothType = BoothType::create([
            'type' => $request->type
        ]);
        $boothType->save();
        //event(new Counter($counter));

        //  Auth::login($user);

        return redirect(RouteServiceProvider::BOOTH_TYPE);
    }

    public function update(Request $request,$id): RedirectResponse
    {
       $validatedData= $request->validate([
            'type' => 'required|string|max:255']
        );

        $resource=BoothType::find((int)$id);

        
        $resource->update($validatedData);
        //event(new Counter($counter));

        //  Auth::login($user);

        return redirect(RouteServiceProvider::BOOTH_TYPE);
    }
}
