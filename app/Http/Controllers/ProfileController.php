<?php

namespace App\Http\Controllers;

use App\Banque;
use Illuminate\Support\Facades\Auth;
use App\Rules\MatchOldPassword;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\User as UserResource;
use App\User;
use App\Http\Resources\VilleAC as VilleACResource;
use App\Http\Resources\BanqueAC as BanqueACResource;
use App\Ville;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::guard()->user();

        return response()->json([
            'villes' => VilleACResource::collection(Ville::get()),
            'user' => UserResource::collection([$user])[0],
        ]);
    }

    public function create()
    {
        $fonctionalite = null;
        return view('fonctionalites.form', compact('fonctionalite'));
    }

    public function store(Request $request)
    {
        $user = Auth::guard()->user();

        $rules = [
            'nom' => 'required',
            'prenom' => 'required',
            'email' => ['required'],
            'tel' => ['required']
        ];

        $rules['email'][] = Rule::unique('users')->ignore($user->id);
        $rules['tel'][] = Rule::unique('users')->ignore($user->id);

        $validte = $request->validate($rules);
        if ($validte) {

            $user->prenom =  ($request->get('prenom') != 'null') ? $request->get('prenom') : null;
            $user->nom =  ($request->get('nom') != 'null') ? $request->get('nom') : null;
            $user->email =  ($request->get('email') != 'null') ? $request->get('email') : null;
            $user->email =  ($request->get('email') != 'null') ? $request->get('email') : null;
            $user->tel =  ($request->get('tel') != 'null') ? $request->get('tel') : null;
            $user->cni =  ($request->get('cni') != 'null') ? $request->get('cni') : null;
            $user->fonction =  ($request->get('fonction') != 'null') ? $request->get('fonction') : null;
            $user->ville_id =  ($request->get('ville_id') != 'null') ? $request->get('ville_id') : null;
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->file('image')->extension();
                $path = $request->file('image')->storeAs(
                    'avatars',
                    $imageName
                );
                $user->image = $imageName;
            }

            $user->save();

            return UserResource::collection([$user])[0];
        }

        //return redirect('/fonctionalites')->with('success', 'Profile saved!');
    }

    public function change_password(Request $request)
    {
        $user = Auth::guard()->user();

        $request->validate([
            'actuel' => ['required', new MatchOldPassword],
            'nouveau' => ['required'],
            'confirmation' => ['same:nouveau'],

        ]);

        $user->password =  Hash::make($request->nouveau);
        $user->save();
        return UserResource::collection([$user])[0];
    }

    public function show($id)
    {
    }
}
