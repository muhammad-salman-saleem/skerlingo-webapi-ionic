<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Actualite as ActualiteResource;
use App\Actualite;
use App\Ville;
use App\Http\Resources\VilleAC as VilleACResource;
use App\User;

class ActualiteController extends Controller
{
    public function index(Request $request)
    {

        $actualites = Actualite::get();
        return response()->json([
            'actualites' => ActualiteResource::collection($actualites),
            'villes' => VilleACResource::collection(Ville::get()),
        ]);
    }

    public function create()
    {
        $actualite = null;
        return view('actualites.form', compact('actualite'));
    }

    public function store(Request $request)
    {

        $rules = [
            'label' => 'required'
        ];

        if ($request->get('id') != 'null') {
            $actualite = Actualite::find($request->get('id'));
        } else {
            $actualite = new Actualite();
        }

        $validte = $request->validate($rules);
        if ($validte) {

            $actualite->label =  $request->get('label');
            $actualite->description =  $request->get('description');
            $actualite->intro =  $request->get('intro');
            $actualite->enabled =  ($request->get('enabled') === 'true' || $request->get('enabled') === '1') ? true : false;
            $actualite->date =  ($request->get('date') != 'null') ? $request->get('date') : date('Y-m-d H:i:s');
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->file('image')->extension();
                $path = $request->file('image')->storeAs(
                    'actualites',
                    $imageName
                );
                $actualite->image = $imageName;
            }

            $actualite->save();

            if ($actualite->save()) {
                return new ActualiteResource($actualite);
            }
        } else {
        }

        //return redirect('/actualites')->with('success', 'Actualite saved!');
    }

    public function show($id)
    {
        $actualites = Actualite::where('parent_id', $id)->get();
        return ActualiteResource::collection($actualites);
    }

    public function edit($id)
    {
        $actualite = Actualite::find($id);
        return view('actualites.form', compact('actualite'));
    }

    public function destroy($id)
    {

        $actualite = Actualite::find($id);
        $actualite->delete();

        return true;
        //return redirect('/actualites')->with('success', 'Actualite deleted!');
    }

    private function guard()
    {
        return Auth::guard();
    }
}
