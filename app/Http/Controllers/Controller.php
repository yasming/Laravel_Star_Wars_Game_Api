<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use JWTAuth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function apiResponseSuccess($planet)
    {
        return response()->json(['data' => [ 'message' => 'You visited the planet: '. $planet->name ]]);
    }

    public function apiResponseError($message)
    {
        return response()->json(['data' => ['message' => $message]], 422);
    }

    public function apiResponseRegisterUserSuccess()
    {
        return response()->json(['data' => ['message' => 'User registered with success']]);
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
