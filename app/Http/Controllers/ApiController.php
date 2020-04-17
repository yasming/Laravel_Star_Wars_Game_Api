<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchPlanetRequest;
use App\Http\Requests\VisitPlanetRequest;
use App\Http\Resources\PlanetCollection;
use App\Http\Resources\UserCollection;
use App\Models\Planet;
use App\Models\User;

class ApiController extends Controller
{
    public function visitPlanet(Planet $planet)
    {
        $attachedPlanetToUsers = $planet->users()->syncWithoutDetaching($this->getAuthenticatedUser()->id);
        if(empty($attachedPlanetToUsers['attached']))
        {
            return $this->apiResponseError(Planet::MESSAGE_PLANET_NOT_VISITED);

        }else return $this->apiResponseSuccess($planet);

    }

    public function searchPlanet(SearchPlanetRequest $request)
    {
        $planet = Planet::where('name', ucfirst($request->name))->get();

        if($planet->isEmpty())
        {
            return $this->apiResponseError(Planet::MESSAGE_PLANET_NOT_FOUND);
        }else return new PlanetCollection($planet);

    }

    public function showPlanetsVistors()
    {
        $planetsThatWereVisited = Planet::whereHas('users')
                                        ->get();

        return new PlanetCollection($planetsThatWereVisited->load('users'));
    }

    public function showVisitorsRanking()
    {
        $rankingOfUsers= User::withCount('planets as number_of_planets_visited')
                              ->orderByRaw('number_of_planets_visited desc')
                              ->get();

        return new UserCollection($rankingOfUsers);
    }
}
