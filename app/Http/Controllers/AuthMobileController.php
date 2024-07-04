<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Client;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Scopes\AgenceScope;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use App\Http\Resources\Client as ClientResource;
use App\Http\Resources\Utilisateur;
use Sichikawa\LaravelSendgridDriver\Transport\SendgridTransport;

use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;

class AuthMobileController extends Controller
{

    public function register(Request $request)
    {

        $messages = [
            'email.unique' => 'cette adresse e-mail est déjà associée à un autre compte',
        ];

        $v = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            //'tel' => 'unique:users',
            'password'  => 'required|min:3',
        ], $messages);

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

        /*
        $agence = \App\Agence::where('key', $request->header('AppKey'))->first();
        if (!$agence)
            return response()->json(['error' => 'Unauthorized Agence !!'], 403);
        */

        $user = new User;
        $user->nom = $request->lastName;
        $user->prenom = $request->firstName;
        $user->email = $request->email;
        //$user->tel = $request->tel;
        //$user->agence_id = $agence->id;
        $user->password = bcrypt($request->password);
        $user->save();

        /*
        $client = new Client();
        $client->agence_id = $agence->id;
        $client->user_id = $user->id;
        $client->save();
        */

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

    public function update(Request $request)
    {

        $user = $this->guard()->user();
        $client = $user->client;

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

        if ($request->image) {

            $base64_image = $request->image; // your base64 encoded     
            @list($type, $file_data) = explode(';', $base64_image);
            @list(, $file_data) = explode(',', $file_data);
            $imageName = time() . '.' . 'jpeg';
            Storage::disk('local')->put('avatars/' . $imageName, base64_decode($file_data));


            $user->image = $imageName;
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

        $data = Utilisateur::collection([$user])[0];

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

        if ($token = $this->guard()->attempt($credentials)) {

            $user = $this->guard()->user();


            if ($user) {
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
            /*
            $agence = AgenceScope::$agence;
            if (!$client) {
                $client = new Client();
                $client->agence_id = $agence->id;
                $client->user_id = $user->id;
                $client->save();
            }
            $user->agence_id = $agence->id;
            $user->save();
            */
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

    public function forgot_password(Request $request)
    {
        $user = \App\User::where('email', $request->login)->first();

        if (!$user) {

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


        $passwordRand =  Str::random(6);
        $user->password =  Hash::make($passwordRand);
        $user->save();

        $agence = AgenceScope::$agence;
        Mail::send([], [], function (Message $message) use ($user, $agence, $passwordRand) {
            $message
                ->to($user->email)
                ->embedData([
                    'personalizations' => [
                        [
                            'dynamic_template_data' => [
                                'subject' => $agence->label . ' : Réinitialisation du mot de passe',
                                'login' => $user->email,
                                'logo' => $agence->getImage(),
                                'img' => $user->getImage(),
                                'password'  => $passwordRand,
                            ],
                        ],
                    ],
                    'template_id' => 'd-145543fb6d0443968324af8be7da9ae6',
                ], SendgridTransport::SMTP_API_NAME);
        });

        return [
            'algo' => 'none',
            'status' => '200',
            'data' => json_encode([
                'success' => true,
                'error' => true,
                'message' => 'Merci de consulter votre boite email, un email vous a été envoyé, contenant votre nouveau mot de passe.',
                'to' => $user,
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
