<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        //dd($request->name);
        $userCreate = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status_user' => 'kich_hoat'
        ]);

        return response()->json([
            'code' => 201,
            'data' => $userCreate
        ], 201);
    }
}
