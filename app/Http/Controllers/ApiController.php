<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchPlanetRequest;
use App\Http\Requests\VisitPlanetRequest;
use App\Http\Resources\PlanetCollection;
use App\Models\Planet;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function visitPlanet(Planet $planet, VisitPlanetRequest $request)
    {
        $attachedPlanetToUsers = $planet->users()->sync($request->user_id);
        if(empty($attachedPlanetToUsers['attached']))
        {
            return $this->apiResponseError($planet);

        }else return $this->apiResponseSuccess($planet);

    }

    public function searchPlanet(SearchPlanetRequest $request)
    {
        $planet = Planet::where('name', ucfirst($request->name))->get();
        return new PlanetCollection($planet);

    }

    public function showPlanetsVistors()
    {
        $planetsThatWereVisited = Planet::whereHas('users')
                                        ->get();
        return new PlanetCollection($planetsThatWereVisited->load('users'));
    }
}
