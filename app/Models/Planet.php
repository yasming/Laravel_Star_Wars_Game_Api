<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Planet extends Model
{
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
