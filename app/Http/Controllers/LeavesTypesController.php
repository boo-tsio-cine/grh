<?php

namespace App\Http\Controllers;

use App\Models\Leaves_types;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LeavesTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //
        $conge = Leaves_types::orderBy("name")->get();
        return view("conge.conge", compact('conge'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validates = $request->validate([
            'name' => 'required|string',
            'max_days' => 'required|int',
            'description' => 'required|string',
        ]);

        Leaves_types :: create($validates);

        return redirect('/conge')->with('success','Insertion congé avec succes');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Leaves_types $leaves_types)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leaves_types $leaves_types)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Leaves_types $leaves_types, $id)
    {
        //
        $update = Leaves_types::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'max_days' => 'required|int',
            'description' => 'required|string',
        ]);

        $update -> update([
            'name' => $request->name,
            'max_days' => $request->max_days,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Congée mis à jour avec succès !');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Leaves_types $leaves_types,$id)
    {
        //

        $del = Leaves_types::findOrFail($id);

        $del -> delete();

        return redirect()->back()->with('info','Suppression de congée réussi');

    }
}
