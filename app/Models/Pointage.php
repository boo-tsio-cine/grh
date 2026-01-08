<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pointage extends Model
{
    //
    use HasFactory;

    protected $table = 'pointages';

    protected $fillable = [
        'id_employee',
        'check_in',
        'check_out',
        'hours_worked',
        'date',
    ];



    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function departement(){
        return $this->belongsTo(Departement::class);
    }
}
