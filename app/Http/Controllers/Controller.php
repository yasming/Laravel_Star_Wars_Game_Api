<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

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

    public function getAuthenticatedUser()
    {
    	try {

    		if (! $user = JWTAuth::parseToken()->authenticate()) {
    			return response()->json(['user_not_found'], 404);
    		}

    	} catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

    		return response()->json(['token_expired'], $e->getStatusCode());

    	} catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

    		return response()->json(['token_invalid'], $e->getStatusCode());

    	} catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

    		return response()->json(['token_absent'], $e->getStatusCode());

    	}
    	// the token is valid and we have found the user via the sub claim
    	return $user;
    }
}
