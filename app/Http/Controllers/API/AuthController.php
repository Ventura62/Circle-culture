<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    use  AuthenticatesUsers;

    protected $maxAttempts  = 5; // Amount of bad attempts user can make
    protected $decayMinutes = 1; // Time for which user is going to be blocked in minutes

    /**
     * Get a JWT via given credentials.
     *
     * @param Request $request
     *
     * @return JsonResponse
     * @throws ValidationException
     */
    public function token(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Invalid Credentials'], 401);
        }

        if (! $token = $this->auth()->login($user)) {
            return response()->json(['error' => 'Invalid Credentials'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh(Request $request)
    {
        $request->validate([
            'refresh_token'=> 'required'
        ]);

        return $this->respondWithToken($request->get('refresh_token'));
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => $this->auth()->factory()->getTTL() * 60,
        ]);
    }

    /**
     * Get auth with guard api.
     * @return Factory|Guard|StatefulGuard
     */
    private function auth()
    {
        return auth('api');
    }


}
