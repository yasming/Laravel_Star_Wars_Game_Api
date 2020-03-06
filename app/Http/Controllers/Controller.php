<?php

namespace App\Http\Controllers;

use App\Models\Planets;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use GuzzleHttp\Client;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function requestApi()
    {
        $page = 1;
        $responseJson = $this->makeRequestToStarWarsApi($page);
        // dd($responseJson['next']);
    }

    public function makeRequestToStarWarsApi($page)
    {
        $client = new Client();
        $response = $client->request('GET', ENV('API_STAR_WARS'). '?page=' . $page);

        $responseJson = json_decode($response->getBody(), true);
        return $responseJson;
    }
}
