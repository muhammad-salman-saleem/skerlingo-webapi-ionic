<?php

namespace App\Http\Controllers;

use App\Fiche;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Ville;
use App\Traduction;
use App\User;
use App\Http\Resources\VilleAC as VilleACResource;
use App\Http\Resources\TraductionAC as TraductionResource;
use App\Http\Resources\TraductionTree as TraductionTreeResource;
use App\Http\Resources\TraductionRubriqueAC as TraductionRubriqueACResource;
use App\Http\Resources\TraductionRubriqueTree;
use App\Http\Resources\TraductionRubriqueTreeAC as TraductionRubriqueTreeACResource;
use App\TraductionQuestion;
use App\TraductionRubrique;
use Illuminate\Support\Str;

class TraductionController extends Controller
{
    public function index(Request $request)
    {

        $types = [];
        $types[] = ['value' => 'input', 'text' => 'Zone de texte'];
        $types[] = ['value' => 'textarea', 'text' => 'Long texte'];
        $types[] = ['value' => 'editor', 'text' => 'Editeur de texte'];


        $rubriques = [];
        $dataTree = [];

        $dataTree = TraductionTreeResource::collection(Traduction::orderBy('ordre')->where('rubrique_id', 23)->get());
        $rubriques = TraductionRubriqueACResource::collection(TraductionRubrique::whereNotNull('parent_id')->orderBy('ordre')->get());

        return response()->json([
            'dataTree' => $dataTree,
            'rubriques' => $rubriques,
            'types' => $types,
        ]);
    }

    public function table(Request $request)
    {

        $langues = [];
        $langues[] = ['value' => 'en', 'text' => 'EN'];
        $langues[] = ['value' => 'fr', 'text' => 'FR'];


        if ($request->get('langue'))
            app()->setLocale($request->get('langue'));

        $rubriques = TraductionRubriqueTreeACResource::collection(TraductionRubrique::orderBy('ordre')->get());


        $traductions = [];
        if ($request->get('rubrique')) {
            $traductions = Traduction::where(function ($query) use ($request) {
                if ($request->get('rubrique')) {
                    $query->where('rubrique_id', $request->get('rubrique'));
                }

                if ($request->get('client')) {
                    $query->where('client_id', $request->get('client'));
                }
            })->orderBy('ordre')->get();
        }
        $traductions = TraductionTreeResource::collection($traductions);

        return response()->json([
            'traductions' => $traductions,
            'rubriques' => $rubriques,
            'langues' => $langues,
            'langue' => app()->getLocale()
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
            $statut = Traduction::find($item['id']);
            $statut->ordre = $ordre;
            $statut->save();
            $ordre++;

            foreach ($item['children'] as $item_child) {
                $statut_child = Traduction::find($item_child['id']);
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
            $statut = Traduction::find($request->get('id'));
        } else {
            $statut = new Traduction();
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

        //return redirect('/types')->with('success', 'Traduction saved!');
    }

    public function save_partie(Request $request)
    {

        $traduction = Traduction::find($request->get('id'));

        $traduction->setTranslation('value', $request->get('langue'), str_replace('"', "'", $request->get('value')));
        $traduction->save();

        //return redirect('/types')->with('success', 'Traduction saved!');
    }

    public function show($id)
    {
        $types = Traduction::where('parent_id', $id)->get();
        return $types;
    }

    public function edit($id)
    {
        $statut = Traduction::find($id);
        return view('types.form', compact('statut'));
    }

    public function destroy($id)
    {

        $statut = Traduction::find($id);
        $statut->delete();

        return true;
        //return redirect('/types')->with('success', 'Traduction deleted!');
    }
}
