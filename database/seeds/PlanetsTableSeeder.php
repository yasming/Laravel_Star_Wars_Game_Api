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
    public function apiResponse()
    {
        return response()->json(['msg' => 'The make were seed with Star Wars planets']);
    }
}
