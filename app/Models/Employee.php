<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //

    use HasFactory;

    protected $table = 'employees';

    protected $fillable = [
            'last_name',
            'first_name',
            'gender',
            'ddn',
            'phone',
            'mail',
            'addresse',
            'departement_id',
            'position',
            'salary_base',
            'hire_date',
            'photo',
            'contrat',
    ];


      // L'employé appartient à un département
    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    //  public function leave()
    // {
    //     return $this->hasMany(Leaves::class, 'employee_id');
    // }

    public function leaves()
    {
        return $this->hasMany(Leaves::class, 'employee_id');
    }

     public function pointages()
    {
        return $this->hasMany(Pointage::class, 'id_employee');
    }
}
