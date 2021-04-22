<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name', 
        'email', 
        'address',
        'phone',
        'sallery',
        'joining_date',
        'nid',
        'photo',
    ];
}
