<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\User;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function information(Request $request)
    {
        $user = $request->user();
        return response()->json($user);

    }
}
