<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\User;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Request User Information.
     *
     * @OA\Get(
     *   path="/api/user",
     *   tags={"Display User Information"},
     *   summary="Display all data of current user",
     *   @OA\Response(
     *     response=200,
     *     description="User data retrieved successfully",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *     )
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Unauthenticated"
     *   )
     * )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function information(Request $request)
    {
        $user = $request->user();
        return response()->json($user);
    }
}
