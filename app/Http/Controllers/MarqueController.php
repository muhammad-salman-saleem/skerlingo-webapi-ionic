<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Marque;
use App\User;
use App\Http\Resources\Marque as MarqueResource;

class MarqueController extends Controller
{
    public function index(Request $request)
    {

        return response()->json([
            'marques' => MarqueResource::collection(Marque::get()),
        ]);
    }

    public function create()
    {
        $marque = null;
        return view('marques.form', compact('marque'));
    }

    public function store(Request $request)
    {
        $rules = [
            'text' => 'required'
        ];

        if ($request->get('id') && $request->get('id') != 'null') {
            $marque = Marque::find($request->get('id'));
        } else {
            $marque = new Marque();
        }

        $validte = $request->validate($rules);
        if ($validte) {

            $marque->label =  $request->get('text');
            $marque->enabled =  ($request->get('enabled') === 'true' || $request->get('enabled') === '1') ? true : false;

            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->file('image')->extension();
                $path = $request->file('image')->storeAs(
                    'marques',
                    $imageName
                );
                $marque->image = $imageName;
            }

            $marque->save();

            if ($marque->save()) {
                return new $marque;
            }
        } else {
        }

        //return redirect('/marques')->with('success', 'Marque saved!');
    }

    public function show($id)
    {
        $marques = Marque::where('parent_id', $id)->get();
        return $marques;
    }

    public function edit($id)
    {
        $marque = Marque::find($id);
        return view('marques.form', compact('marque'));
    }

    public function destroy($id)
    {

        $marque = Marque::find($id);
        $marque->delete();

        return true;
        //return redirect('/marques')->with('success', 'Marque deleted!');
    }
}
