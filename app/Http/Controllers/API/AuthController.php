<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    /**
     * Login user using API
    *
    * @return \Illuminate\Http\Response
    */
    public function login(Request $request)
    {
        $request->validate([

        ]);

        if ($request->social) {
            $user = User::where('social_id', $request->id)->orWhere('email', $request->email)->first();

            if (! $user && $request->social) {
                $login = new LoginController;
                $user = $login->registerNewUser($request, $request->social);
            }

            Auth::login($user, true);
        } else {
            $credentials[preg_match('/@/', $request->email) ? 'email' : 'name'] = $request->email;
            $credentials['password'] = $request->password;

            if (! Auth::attempt($credentials, true))
                return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;

        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addMonths(3);
        
        $token->save();
        
        return [
            'user' => $user,
            'access_token' => $tokenResult->accessToken,
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
        ];
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->stateless()->user();
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return [
            'message' => 'Successfully logged out'
        ];
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\Response
     */
    public function user(Request $request)
    {
        return $request->user();
    }
}
