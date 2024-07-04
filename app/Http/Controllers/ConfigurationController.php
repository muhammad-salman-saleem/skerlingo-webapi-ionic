<?php

namespace App\Http\Controllers;

use App\Fiche;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Ville;
use App\AppConfig;
use App\User;
use App\Http\Resources\VilleAC as VilleACResource;
use App\Http\Resources\ConfigurationAC as ConfigurationResource;
use App\Http\Resources\ConfigurationTree as ConfigurationTreeResource;
use App\Http\Resources\ConfigurationRubriqueAC as ConfigurationRubriqueACResource;
use App\Http\Resources\ConfigurationRubriqueTree;
use App\Http\Resources\ConfigurationRubriqueTreeAC as ConfigurationRubriqueTreeACResource;
use App\ConfigurationQuestion;
use App\ConfigurationRubrique;
use Illuminate\Support\Str;

class ConfigurationController extends Controller
{
    public function index(Request $request)
    {

        return response()->json([]);
    }

    public function table(Request $request)
    {

        $configurations = AppConfig::where(function ($query) use ($request) {
        })->get();
        $configurations = ConfigurationTreeResource::collection($configurations);

        return response()->json([
            'configurations' => $configurations,
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
            $statut = AppConfig::find($item['id']);
            $statut->ordre = $ordre;
            $statut->save();
            $ordre++;

            foreach ($item['children'] as $item_child) {
                $statut_child = AppConfig::find($item_child['id']);
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
            $statut = AppConfig::find($request->get('id'));
        } else {
            $statut = new Configuration();
        }

        $questions = json_decode($request->get('questions'), true);

        $validte = $request->validate($rules);
        if ($validte) {

            $statut->label =  ($request->get('text') != 'null') ? $request->get('text') : null;
            $statut->type =  ($request->get('type') != 'null') ? $request->get('type') : null;
            $statut->alias = Str::slug($statut->label);
            $statut->rubrique_id =  ($request->get('rubrique_id') != 'null') ? $request->get('rubrique_id') : null;
            $statut->enable =  ($request->get('enable') === 'true' || $request->get('enable') === '1') ? true : false;

            $statut->save();

            if ($statut->save()) {
                return new $statut;
            }
        } else {
        }

        //return redirect('/types')->with('success', 'Configuration saved!');
    }

    public function save_partie(Request $request)
    {

        $traduction = AppConfig::find($request->get('id'));

        $traduction->value =  $request->get('value');
        $traduction->save();

        //return redirect('/types')->with('success', 'Configuration saved!');
    }

    public function show($id)
    {
        $types = AppConfig::where('parent_id', $id)->get();
        return $types;
    }

    public function edit($id)
    {
        $statut = AppConfig::find($id);
        return view('types.form', compact('statut'));
    }

    public function destroy($id)
    {

        $statut = AppConfig::find($id);
        $statut->delete();

        return true;
        //return redirect('/types')->with('success', 'Configuration deleted!');
    }
}
