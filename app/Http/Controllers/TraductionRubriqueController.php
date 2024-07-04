<?php

namespace App\Http\Controllers;

use App\Fiche;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Ville;
use App\TraductionRubrique;
use App\User;
use App\Http\Resources\VilleAC as VilleACResource;
use App\Http\Resources\TraductionRubriqueAC as TraductionRubriqueResource;
use App\Http\Resources\TraductionRubriqueTree as TraductionRubriqueTreeResource;
use App\TraductionRubriqueQuestion;
use Illuminate\Support\Str;

class TraductionRubriqueController extends Controller
{
    public function index(Request $request)
    {
        $rubriques = [];
        $dataTree = [];

        $dataTree = TraductionRubriqueTreeResource::collection(TraductionRubrique::whereNull('parent_id')->orderBy('ordre')->get());
        $rubriques = TraductionRubriqueResource::collection(TraductionRubrique::whereNull('parent_id')->orderBy('ordre')->get());

        return response()->json([
            'dataTree' => $dataTree,
            'rubriques' => $rubriques,
        ]);
    }

    public function create()
    {
        $statut = null;
        return view('types.form', compact('statut'));
    }


    public function save_order(Request $request)
    {

        $ordre = 1;
        $dataTree = $request->get('dataTree');
        foreach ($dataTree as $item) {
            $statut = TraductionRubrique::find($item['id']);
            $statut->ordre = $ordre;
            $statut->save();
            $ordre++;

            foreach ($item['children'] as $item_child) {
                $statut_child = TraductionRubrique::find($item_child['id']);
                $statut_child->ordre = $ordre;
                $statut_child->save();
                $ordre++;
            }
        }

        return response()->json([
            'title' => 'Ordre modifié !',
            'message' => 'L\'ordre des rubriques a été modifié avec succés.',
            'icon' => 'success',
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'text' => 'required'
        ];

        if ($request->get('id') != 'null') {
            $statut = TraductionRubrique::find($request->get('id'));
        } else {
            $statut = new TraductionRubrique();
        }

        $questions = json_decode($request->get('questions'), true);

        $validte = $request->validate($rules);
        if ($validte) {

            $statut->label =  ($request->get('text') != 'null') ? $request->get('text') : null;
            $statut->alias = Str::slug($statut->label);
            $statut->parent_id =  ($request->get('parent_id') != 'null') ? $request->get('parent_id') : null;
            $statut->enable =  ($request->get('enable') === 'true' || $request->get('enable') === '1') ? true : false;

            $statut->save();

            if ($statut->save()) {
                return new $statut;
            }
        } else {
        }

        //return redirect('/types')->with('success', 'TraductionRubrique saved!');
    }

    public function show($id)
    {
        $types = TraductionRubrique::where('parent_id', $id)->get();
        return $types;
    }

    public function edit($id)
    {
        $statut = TraductionRubrique::find($id);
        return view('types.form', compact('statut'));
    }

    public function destroy($id)
    {

        $statut = TraductionRubrique::find($id);
        $statut->delete();

        return true;
        //return redirect('/types')->with('success', 'TraductionRubrique deleted!');
    }
}
