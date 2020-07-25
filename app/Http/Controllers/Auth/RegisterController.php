<?php
/**
 * Register Controller
 * php version 7.2.10
 *
 * @category Components
 * @package  None
 * @author   Eduardo Sanchez <walkovik@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @version  GIT: @1.0.0
 * @link     https://github.com/walkovik/testboalt
 */
namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\User;

/**
 * Class RegisterController
 *
 * @category Components
 * @package  App\Http\Controllers\Auth
 * @author   Eduardo Sanchez <walkovik@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @version  Release: @1.0.0
 * @link     https://github.com/walkovik/testboalt
 */
class RegisterController extends Controller
{
    /**
     * Register Controller
     *
     * @param RegisterRequest $request The Request
     *
     * @OA\Post(
     *   path="/api/auth/register",
     *   tags={"Register"},
     *   summary="Register user to the api",
     *   @OA\Parameter(
     *     name="name",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *       type="string"
     *     )
     *   ),
     *   @OA\Parameter(
     *     name="email",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *       type="string"
     *     )
     *   ),
     *   @OA\Parameter(
     *     name="password",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *       type="string"
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="User successfully registered",
     *     @OA\MediaType(
     *       mediaType="application/json",
     *     )
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="Unauthenticated"
     *   )
     * )
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]
        );
        return response()->json(['message' => 'Register Successfully'], 201);
    }
}
