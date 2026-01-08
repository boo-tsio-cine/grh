<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Leaves;
use App\Models\Leaves_types;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LeavesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        //

        // $demande = Leaves::orderBy('created_at')->get();

        $valid = Leaves::orderBy('end_date','desc')->with('employee')->where('status','accepte')->get();
        $type = Leaves_types::orderBy('name')->get();
        $conge = Leaves::orderBy('created_at','desc')->with('employee')->get();
        $user = Employee::orderBy('last_name')->get();

        return view('conge.index', compact('user','type','conge','valid'));

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

        $validate = $request->validate([
            'employee_id' => 'required|integer',
            'type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Renommage du fichier
        // $files = $request->file('file');
        if($request->file !== " "){
            $fileName =time().'.'.$request->file->extension();
            $request->file->move(public_path('file'), $fileName);

        }else{
            $fileName = null;
        }
        
        $validate['file'] = $fileName;

        Leaves::create($validate);

        return redirect('/moduleconge')->with('success','Congée enegistrées avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Leaves $leaves)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leaves $leaves)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Leaves $leaves, $id)
    {
        //

        $request->validate([
            'status' => 'required|in:accepte,refuse',
        ]);

        $leave = Leaves::findOrFail($id);
        $leave->status = $request->status;
        $leave->save();

        return back()->with('success', 'Décision enregistrée');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Leaves $leaves)
    {
        //
    }
}
