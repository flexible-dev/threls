<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\UserSigninRequest;
use App\Http\Requests\Api\Auth\UserSignupRequest;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function userSignup(UserSignupRequest $req) {
        $userInfo = $req->validated();
        $userInfo['password'] = Hash::make($userInfo['password']);

        $user = User::Create($userInfo);

        // Email Notfication for welcome and email verification by Queue : Todo
        /**
         *
         */

        $authToken = auth('api')->login($user);

        return response()->json([
            "success" => true,
            "data" => [
                "_token" => $authToken
            ],
            "message" => "A new user has been signed up successfully."
        ]);
    }

    public function userSignin(UserSigninRequest $req) {
        $userCredentials = $req->validated();

        $authToken = auth('api')->attempt($userCredentials);

        $responseBody = [
            "success" => false,
            "data" => null,
            "message" => "Wrong Credentials"
        ];


        throw_if(($authToken === false || is_null($authToken)),
            new HttpResponseException(response()->json($responseBody, Response::HTTP_UNAUTHORIZED)));

        $responseBody = [
            "success" => true,
            "data" => [
                "_token" => $authToken
            ],
            "message" => "The user has been logged in successfully."
        ];

        return response()->json($responseBody);
    }

    public function userLogout() {
        auth('api')->logout();

        return response()->json([
            "success" => true,
            "data" => null,
            "message" => "The user has been logged out successfully."
        ]);
    }
}
