<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //()

        $dep = Departement::orderBy('abrev')->get();
        return view('departement.index', compact('dep'));

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

        $validated = $request->validate([
            'name' => 'required|string',
            'abrev' => 'required|string',
            'descri' => 'required|string',
            'id_employee'=>'nullable|int',
        ]);

        Departement::create($validated);

        return redirect('/departement')->with('succes','Insertion departement avec succes');

    }

    /**
     * Display the specified resource.
     */
    public function show(Departement $departement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Departement $departement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        //
        $update = Departement::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'abrev' => 'required|string',
            'descri' => 'required|string',
            'id_employee'=>'nullable|int',
        ]);

        $update -> update([
            'name'=>$request->name,   
            'abrev'=>$request->abrev,   
            'descri'=>$request->descri,   
            'id_employee'=>$request->id_employee,   
        ]);

        return redirect()->back()->with('success', 'Département mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Departement $departement, $id)
    {
        //
        $dep = Departement :: findOrFail($id);

        $dep->delete($id);

        return redirect()->back()->with('info','Suppression de Depatement réussi');


    }
}
