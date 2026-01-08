<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    //
    use HasFactory;

    protected $table = "departements";

    protected $fillable = [
        'name',
        'abrev',
        'descri',
        'id_employee',
    ];


     // Un département contient plusieurs employés
    public function employees()
    {
        return $this->hasMany(Employee::class, 'departement_id');
    }

      public function pointage()
    {
        return $this->hasMany(Pointage::class);
    }
}
