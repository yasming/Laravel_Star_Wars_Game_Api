<?php

use Illuminate\Database\Seeder;
use GuzzleHttp\Client;
use App\Models\Planet;

class PlanetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $page = 1;
        $this->getFirstPlanet();
        // api isnt returning the first planet
        $responseJson = $this->makeRequestToStarWarsApi($page);
        return $responseJson;

    }

    public function makeRequestToStarWarsApi($page)
    {
        $client = new Client();
        $response = $client->request('GET', ENV('API_STAR_WARS'). '?page=' . $page);
        $responseJson = json_decode($response->getBody(), true);
        foreach($responseJson['results'] as $planet)
        {
            $planet['residents'] = implode(',',$planet['residents']);
            $planet['films'] = implode(',',$planet['films']);
            Planet::create($planet);
        }
        if($responseJson['next'] != null)
        {
            $page += 1;
            $this->makeRequestToStarWarsApi($page);
        }
        else
        {
            return $this->apiResponse();
        }
    }

    public function getFirstPlanet()
    {
        $client = new Client();
        $response = $client->request('GET', ENV('API_STAR_WARS'). '1');
        $responseJson = json_decode($response->getBody(), true);

        $responseJson['residents'] = implode(',',$responseJson['residents']);
        $responseJson['films'] = implode(',',$responseJson['films']);
        $planet = Planet::create($responseJson);
        return $planet;

    }
    public function apiResponse()
    {
        return response()->json(['msg' => 'The planets table were seed with Star Wars planets']);
    }
}
