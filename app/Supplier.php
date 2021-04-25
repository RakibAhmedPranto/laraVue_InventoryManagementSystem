<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'email',
        'address',
        'phone',
        'shop_name',
        'photo',
    ];
}
