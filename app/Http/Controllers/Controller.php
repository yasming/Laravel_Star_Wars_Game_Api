<?php

namespace App\Http\Controllers;

use App\Models\Planet;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use GuzzleHttp\Client;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function apiResponseSuccess($planet)
    {
        return response()->json(['message' => 'You visited the planet: '. $planet->name ]);
    }

    public function apiResponseError($planet)
    {
        return response()->json(['message' => 'Oops.. Have you ever visit this planet ! Choose another planet to visit .'], 422);
    }
}
