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
            $message = 'Oops.. Have you ever visit this planet! Choose another planet to visit .';
            return $this->apiResponseError($message);

        }else return $this->apiResponseSuccess($planet);

    }

    public function searchPlanet(SearchPlanetRequest $request)
    {
        $planet = Planet::where('name', ucfirst($request->name))->get();

        if($planet->isEmpty())
        {
            $message = "Sorry.. this planet couldn't be found, please, type a right planet's name .";
            return $this->apiResponseError($message);
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
        $rankingOfUsers= User::withCount('planets as number_of_user_visits_to_planets')
                              ->orderByRaw('number_of_user_visits_to_planets desc')
                              ->get();

        return new UserCollection($rankingOfUsers);
    }
}
