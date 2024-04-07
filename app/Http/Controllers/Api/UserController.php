<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUserInfo(Request $request)
    {
        // return $request;

        if ($request->user()) {

            $user = $request->user();

            return response()->json([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,

            ]);

        } else {

            return response()->json([
                'error' => 'Unauthenticated',
            ], 401);
        }
    }
}
