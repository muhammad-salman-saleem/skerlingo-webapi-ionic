<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Utilisateur as UtilisateurResource;
use App\Client;
use App\ClientDocument;
use App\Http\Resources\Professeur as ProfesseurResource;
use App\Http\Resources\VilleAC as VilleACResource;
use App\Http\Resources\ClientDocument as ClientDocumentResource;
use App\Ville;
use App\User;

class UtilisateurController extends Controller
{
    public function index(Request $request)
    {

        $user = $this->guard()->user();
        $client = null;
        //$client = $user->client;

        $utilisateurs = User::where(function ($query) use ($request, $client, $user) {
            if ($client) {
                $query->where('client_id', $client->id);
            } else {
                $query->where('role_id', 1);
            }
        })->get();

        /*
        foreach ($utilisateurs as $item) {
            $item->code_retour =  strtolower(Str::random(5));
            $item->password_retour =  rand(10000, 99999);
            $item->save();
        }
        */

        return response()->json([
            'utilisateurs' => UtilisateurResource::collection($utilisateurs)
        ]);
    }

    public function profile(Request $request)
    {
        $client = null;
        if ($request->get('id')) {
            $client = Client::find($request->get('id'));
        }

        $documents = ClientDocument::where('client_id', $client->id)->get();

        return response()->json([
            'villes' => VilleACResource::collection(Ville::get()),
            'banques' => BanqueACResource::collection(Banque::get()),
            'documents' => ClientDocumentResource::collection($documents),
            'client' => $client ? UtilisateurResource::collection([$client])[0] : $client,
        ]);
    }

    public function change_password(Request $request)
    {
        $client = null;
        if ($request->get('id')) {
            $user = User::find($request->get('id'));
        }

        $request->validate([
            //'actuel' => ['required', new MatchOldPassword],
            'nouveau' => ['required'],
            'confirmation' => ['same:nouveau'],

        ]);

        $user->password =  Hash::make($request->nouveau);
        $user->save();
        return true;
    }


    public function send_password(Request $request)
    {
        $client = null;
        if ($request->get('id')) {
            $user = User::find($request->get('id'));
        }

        $password = Str::random(10);
        $user->password =  Hash::make($password);
        $user->save();

        $user->notify(new \App\Notifications\sendTemporaryPasswordExporterNotification($password));

        return true;
    }


    public function valider_client(Request $request)
    {
        $client = null;
        if ($request->get('id')) {
            $client = Client::find($request->get('id'));
        }


        $user = $this->guard()->user();

        $client->validation_user =  $user->id;
        $client->validation_date =  date('Y-m-d H:i:s');
        $client->save();

        $documents = ClientDocument::where('client_id', $client->id)->get();

        return response()->json([
            'villes' => VilleACResource::collection(Ville::get()),
            'banques' => BanqueACResource::collection(Banque::get()),
            'documents' => ClientDocumentResource::collection($documents),
            'client' => $client ? UtilisateurResource::collection([$client])[0] : $client,
        ]);
    }

    public function activer_compte(Request $request)
    {
        $client = null;
        if ($request->get('id')) {
            $client = Client::find($request->get('id'));
        }

        $user = $this->guard()->user();

        $client->enabled =  true;
        $client->save();

        return response()->json([
            'client' => $client ? UtilisateurResource::collection([$client])[0] : $client,
        ]);
    }

    public function bloquer_compte(Request $request)
    {
        $client = null;
        if ($request->get('id')) {
            $client = Client::find($request->get('id'));
        }

        $user = $this->guard()->user();

        $client->enabled =  false;
        $client->save();

        return response()->json([
            'client' => $client ? UtilisateurResource::collection([$client])[0] : $client,
        ]);
    }

    public function create()
    {
        $client = null;
        return view('utilisateurs.form', compact('client'));
    }

    public function store(Request $request)
    {

        $autUser = $this->guard()->user();
        $client = null;
        //$client = $autUser->client;

        $rules = [
            'nom' => 'required',
            'prenom' => 'required',
            'email' => ['required', Rule::unique('users')],
            'tel' => ['required', Rule::unique('users')]
        ];

        $rules = [
            'prenom' => 'required',
            'nom' => 'required',
            'tel' => ['required'],
            'email' => ['required']
        ];

        if ($request->get('id') && $request->get('id') != 'null') {
            $user = User::find($request->get('id'));
            $rules['email'][] = Rule::unique('users')->ignore($user->id);
            $rules['tel'][] = Rule::unique('users')->ignore($user->id);
        } else {

            $rules['email'][] = Rule::unique('users');
            $rules['tel'][] = Rule::unique('users');
            $user = new User();
            $user->password =  Hash::make('test_password');
            $user->code_retour =  Str::random(5);
            $user->password_retour =  rand(10000, 99999);
        }


        $validte = $request->validate($rules);

        $user->prenom =  ($request->get('prenom') != 'null') ? $request->get('prenom') : null;
        $user->nom =  ($request->get('nom') != 'null') ? $request->get('nom') : null;
        $user->email =  ($request->get('email') != 'null') ? $request->get('email') : null;
        $user->tel =  ($request->get('tel') != 'null') ? $request->get('tel') : null;
        $user->cni =  ($request->get('cni') != 'null') ? $request->get('cni') : null;
        $user->fonction =  ($request->get('fonction') != 'null') ? $request->get('fonction') : null;
        $user->entreprise_id =  ($request->get('entreprise_id') != 'null') ? $request->get('entreprise_id') : null;
        if ($user->entreprise_id)
            $user->role_id = 2;
        else
            $user->role_id = 1;
        $user->enabled =  ($request->get('enabled') === 'true' || $request->get('enabled') === '1') ? true : false;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->file('image')->extension();
            $path = $request->file('image')->storeAs(
                'avatars',
                $imageName
            );
            $user->image = $imageName;
        }

        $user->save();

        return response()->json([
            'villes' => VilleACResource::collection(Ville::get()),
            'utilisateur' => $user ? UtilisateurResource::collection([$user])[0] : $user,
        ]);

        //return redirect('/utilisateurs')->with('success', 'Client saved!');
    }

    public function show($id)
    {
        $utilisateurs = Client::where('parent_id', $id)->get();
        return UtilisateurResource::collection($utilisateurs);
    }

    public function edit($id)
    {
        $client = Client::find($id);
        return view('utilisateurs.form', compact('client'));
    }

    public function destroy($id)
    {

        $client = Client::find($id);
        $client->delete();

        return true;
        //return redirect('/utilisateurs')->with('success', 'Client deleted!');
    }

    private function guard()
    {
        return Auth::guard();
    }
}
