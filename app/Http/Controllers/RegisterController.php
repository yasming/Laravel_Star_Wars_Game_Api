<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function store(UserRequest $request)
    {
        User::create($request->all());
        return $this->apiResponseRegisterUserSuccess();
    }
}
