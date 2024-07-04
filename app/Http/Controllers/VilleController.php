<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Ville;
use App\User;
use App\Http\Resources\Ville as VilleResource;

class VilleController extends Controller
{
    public function index(Request $request)
    {

        return response()->json([
            'villes' => VilleResource::collection(Ville::get()),
        ]);
    }

    public function create()
    {
        $ville = null;
        return view('villes.form', compact('ville'));
    }

    public function store(Request $request)
    {
        $rules = [
            'label' => 'required'
        ];

        if ($request->get('id') != 'null') {
            $ville = Ville::find($request->get('id'));
        } else {
            $ville = new Ville();
        }

        $validte = $request->validate($rules);
        if ($validte) {

            $ville->label =  $request->get('label');
            $ville->code =  $request->get('code');
            $ville->save();

            if ($ville->save()) {
                return new $ville;
            }
        } else {
        }

        //return redirect('/villes')->with('success', 'Ville saved!');
    }

    public function show($id)
    {
        $villes = Ville::where('parent_id', $id)->get();
        return $villes;
    }

    public function edit($id)
    {
        $ville = Ville::find($id);
        return view('villes.form', compact('ville'));
    }

    public function destroy($id)
    {

        $ville = Ville::find($id);
        $ville->delete();

        return true;
        //return redirect('/villes')->with('success', 'Ville deleted!');
    }
}
