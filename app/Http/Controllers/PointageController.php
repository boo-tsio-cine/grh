<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Employee;
use App\Models\Pointage;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

// use Illuminate\Support\Facades\View;

class PointageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //

        $employee = Employee::with('pointages')->orderBy("last_name")->get(); 
        $dep = Departement::orderBy("abrev")->get();

        return view('pointage.index', compact('employee','dep'));
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

        $request->validate([
            'id_employee'=>'required|int',
             
        ]);

        Pointage::create([
            'id_employee' => $request->id_employee,
            'check_in' => now()->format('H:i'),
            'date' => now()->toDateString(),
            
        ]);

        return back()->with('success', 'Arrivée enregistrée');

    }

    /**
     * Display the specified resource.
     */
    public function show(Pointage $pointage)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pointage $pointage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pointage $pointage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pointage $pointage)
    {
        //
    }


    public function checkout(int $id): RedirectResponse{
        // Récupération du pointage du jour
        $pointage = Pointage::findOrFail($id);


        // Sécurité : empêche la double sortie
        if($pointage->check_out !== null){
            return back()->with('error', 'La sortie est déjà enregistrée.');
        }  

        // Heure de sortie
        $checkOut = Carbon::now();

        // Calcule des heures de travaille
        $checkIn = Carbon::parse($pointage->check_in);
        $minutes = $checkIn->diffInMinutes($checkOut);
        $hoursWorked = round($minutes / 60, 2); // ex: 7.50 h

        // Mise à jours dans la base
         $pointage->update([
            'check_out' => $checkOut->format('H:i:s'),
            'hours_worked' => $hoursWorked,
        ]);

        return back()->with('success', 'Sortie enregistrée avec succès.');


    }
}
