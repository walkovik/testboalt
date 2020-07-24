<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * @OA\Info(title="API ", version="1.0")
 *
 * @OA\Server(url="http://localhost:8000")
 */
class LoginController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     tags={"Login"},
     *     summary="Login user to the api",
     *      @OA\Parameter(
     *        name="email",
     *        in="query",
     *        required=true,
     *        @OA\Schema(
     *           type="string"
     *        )
     *      ),
     *      @OA\Parameter(
     *        name="password",
     *        in="query",
     *        required=true,
     *        @OA\Schema(
     *           type="string"
     *        )
     *     ),
     *     @OA\Response(
     *      response=200,
     *      description="User successfully logged in",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *       )
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Unauthenticated"
     *     )
     * )
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $credentials = request()->only(['email', 'password']);

        if (!Auth::attempt($credentials))
            return response()->json(['message' => 'Unauthorized'], 401);

        $user = $request->user();

        $token = $user->createToken('Boalt');

        return response()->json([
            'user_id' => $user->id,
            'access_token' => $token->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($token->token->expires_at)->toDateTimeString()]);

    }
}
