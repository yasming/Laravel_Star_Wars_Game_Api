<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Planet extends Model
{
    const messagePlanetNotVisited = "Oops.. Have you ever visit this planet! Choose another planet to visit .";
    const messagePlanetNotFound = "Sorry.. this planet couldn't be found, please, type a right planet's name .";

    protected $fillable = [
        'name',
        'rotation_period',
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
    protected $hidden = ['pivot'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
