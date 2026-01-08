<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Employee;
use App\Models\Leaves;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        //
        $emp = Employee::orderBy("last_name")->with('departement','leaves')->get();
        $dep = Departement::orderBy("abrev")->get();
        // $leave = Leaves::with('leave')->get();
        return view('employee.employee', compact('dep', 'emp'));
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
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'gender' => 'required|string',
            'ddn' => 'required|date',
            'phone' => 'required|string',
            'mail' => 'required|string',
            'addresse' => 'required|string',
            'departement_id' => 'required|int',
            'position' => 'required|string',
            'salary_base' => 'required|string',
            'hire_date' => 'required|date',
            'contrat' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $imageName = time().'.'.$request->photo->extension();

        $request->photo->move(public_path('upload'), $imageName);

        $validate['photo'] = $imageName;

        Employee::create($validate);

        return redirect('/employee')->with('success','Données enegistrées avec succès');

    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        //

        $update = Employee::findOrFail($id);

        $request->validate([
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'gender' => 'required|string',
            'ddn' => 'required|date',
            'phone' => 'required|string',
            'mail' => 'required|string',
            'addresse' => 'required|string',
            'departement_id' => 'required|int',
            'position' => 'required|string',
            'salary_base' => 'required|string',
            'hire_date' => 'required|date',
            'contrat' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasFile('photo')){
            if($update->photo && file_exists(public_path('upload/'.$update->photo))){
                unlink(public_path('upload/'.$update->photo));
            }

            $file = $request->file('photo');
            $fileName = time().'.'.$file->getClientOriginalName();
            $file->move(public_path('upload'),$fileName);
            
            $update->photo = $fileName;
        }


        $update->update([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'gender' => $request->gender,
            'ddn' => $request->ddn,
            'phone' => $request->phone,
            'mail' => $request->mail,
            'addresse' => $request->addresse,
            'departement_id' => $request->departement_id,
            'position' => $request->position,
            'salary_base' => $request->salary_base,
            'hire_date' => $request->hire_date,
            'contrat' => $request->contrat,
            'photo' => $update->photo,
        ]);

        return redirect()->back()->with('success', 'Employée mis à jour avec succès !');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee, $id)
    {
        //
        $del = Employee::findOrFail($id);

        $del -> delete();

        return redirect()->back()->with('info','Suppression d employée réussi');

    }
}
