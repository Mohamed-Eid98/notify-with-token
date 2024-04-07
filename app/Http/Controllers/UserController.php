<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function getUserInfo()
    {
        $user = auth()->user();

        if ($user) {

            $userInfo = [
                'id' => $user->id,
                'name' => $user->name,
            ];

            $accessToken = $user->createToken('authToken')->accessToken;
            $response = Http::withToken($accessToken)->get('http://notify-with-token.test/api/user-info');

            if ($response->successful()) {

                $userInfo = array_merge($userInfo, $response->json());
            } else {

                return response()->json(['error' => 'Unable to fetch user information from the other API'], $response->status());
            }

            return response()->json($userInfo, 200);
        } else {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
    }
}
