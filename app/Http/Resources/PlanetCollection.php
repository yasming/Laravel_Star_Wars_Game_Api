<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PlanetCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $urlExploded = explode('/',$request->url());

        if(end($urlExploded) == "search")
        {
            $planetArray = $this->collection->map->toArray($request)->first();
            $planetModel = $this->collection->first();

            return [

                'id' =>  $planetArray['id'],
                'name' =>  $planetArray['name'],
                'rotation_period' =>  $planetArray['rotation_period'],
                'orbital_period' =>  $planetArray['orbital_period'],
                'diameter' =>  $planetArray['diameter'],
                'climate' =>  $planetArray['climate'],
                'gravity' =>  $planetArray['gravity'],
                'terrain' =>  $planetArray['terrain'],
                'surface_water' =>  $planetArray['surface_water'],
                'population' =>  $planetArray['population'],
                'residents' =>  explode(',', $planetArray['residents']),
                'films' =>  explode(',', $planetArray['films']),
                'created' =>  $planetArray['created'],
                'edited' =>  $planetArray['edited'],
                'url' =>  $planetArray['url'],
                'number_of_visits' => $planetModel->users->count(),
            ];
        }

        else if(end($urlExploded) == "visitors")
        {
            $visitedPlanets = $this->collection->map->only('name', 'users')->toArray($request);

            return [
                $visitedPlanets,
            ];
        }
    }
}
