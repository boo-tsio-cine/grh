<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leaves_types extends Model
{
    //
   use HasFactory;


   protected $table = 'leaves_types';

   protected $fillable = [
        'name',
        'max_days',
        'description',
   ];
}
