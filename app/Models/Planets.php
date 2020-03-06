<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Planets extends Model
{
    protected $fillable = [
        'name',
        'rotations_period',
        'orbital_period',
        'diameter',
        'climate',
        'gravity',
        'terrain',
        'surface_water',
        'population',
        'residents',
        'films',
        'created',
        'edited',
        'url',

    ];
}
