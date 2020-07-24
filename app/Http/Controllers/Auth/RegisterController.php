<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\User;

class RegisterController extends Controller
{

    public function register(RegisterRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);


        return response()->json(['message' => 'Register Successfully'], 201);

    }


}
