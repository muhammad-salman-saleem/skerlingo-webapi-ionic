<?php

namespace App\Http\Controllers;

use App\Fiche;
use App\Http\Resources\RubriqueAC;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Ville;
use App\Slide;
use App\User;
use App\Http\Resources\VilleAC as VilleACResource;
use App\Http\Resources\SlideAC as SlideResource;
use App\Http\Resources\SlideTree as SlideTreeResource;
use App\Rubrique;
use Illuminate\Support\Str;

class SlideController extends Controller
{
    public function index(Request $request)
    {

        $types = [];
        $rubriques = [];
        $dataTree = [];


        $langues = [];
        $langues[] = ['value' => 'fr', 'text' => 'Français'];

        $types = SlideResource::collection(Slide::orderBy('ordre')->get());
        $dataTree = SlideTreeResource::collection(Slide::orderBy('ordre')->get());
        $rubriques = RubriqueAC::collection(Rubrique::where('secteur', 1)->whereNull('parent_id')->orderBy('ordre')->get());

        return response()->json([
            'types' => $types,
            'dataTree' => $dataTree,
            'rubriques' => $rubriques,
            'langues' => $langues,
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
            $statut = Slide::find($item['id']);
            $statut->ordre = $ordre;
            $statut->save();
            $ordre++;

            foreach ($item['children'] as $item_child) {
                $statut_child = Slide::find($item_child['id']);
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

        $langues = [];
        $langues[] = ['value' => 'en', 'text' => 'Anglais'];
        $langues[] = ['value' => 'fr', 'text' => 'Français'];

        $rules = [];
        $rules['text_fr'] = 'required_if:text_en,""';
        $rules['text_en'] = 'required_if:text_fr,""';
        $rules['categorie_id'] = ['required'];
        $rules['icon'] = ['required'];

        if ($request->get('id') && $request->get('id') != 'null') {
            $statut = Slide::find($request->get('id'));
        } else {
            $statut = new Slide();
        }

        $niceNames = array(
            'text_fr' => '<< Nom de la sous catégorie FR >>',
            'text_en' => '<< Nom de la sous catégorie EN >>',
            'categorie_id' => '<< Secteur d\'activité >>',
            'icon' => '<< Image >>',
        );

        $validte = $request->validate($rules, [], $niceNames);
        if ($validte) {

            foreach ($langues as $lang) {
                $statut->setTranslation('label', $lang['value'], $request->get('text_' . $lang['value']) ? str_replace('"', "'", $request->get('text_' . $lang['value'])) : null);
            }
            $statut->categorie_id =  ($request->get('categorie_id') != 'null') ? $request->get('categorie_id') : null;

            if ($request->hasFile('icon')) {
                $imageName = time() . '.' . $request->file('icon')->extension();
                $path = $request->file('icon')->storeAs(
                    'slides',
                    $imageName
                );
                $statut->image = $imageName;
            }

            $statut->save();

            if ($statut->save()) {
                return new $statut;
            }
        } else {
        }

        //return redirect('/types')->with('success', 'Slide saved!');
    }

    public function show($id)
    {
        $types = Slide::where('categorie_id', $id)->get();
        return $types;
    }

    public function edit($id)
    {
        $statut = Slide::find($id);
        return view('types.form', compact('statut'));
    }

    public function menu_admin(Request $request)
    {
        $rubriquesNest = [];
        $rubriques = SlideTreeResource::collection(Slide::where('secteur', 1)->whereNull('parent_id')->orderBy('ordre')->get())->toArray([]);

        foreach ($rubriques as $rubrique) {

            $children = $rubrique['children']->toArray([]);

            if ($rubrique['show_menu'] && count($children) == 0) {
                $rubriquesNest[] = [
                    'id' => $rubrique['id'],
                    'label' => $rubrique['name'],
                    'rappel' => $rubrique['first_rubrique'],
                    'count' => Fiche::whereIn('qualif_mutu_id', [$rubrique['id']])->count(),
                    'children' => [],
                ];
            } elseif ($rubrique['show_menu'] && count($children) > 0) {

                $childs = [];
                $countFiches = 0;

                foreach ($children as $rubrique_child) {
                    if (!$rubrique_child['show_menu'])
                        continue;

                    $count = Fiche::whereIn('qualif_mutu_id', [$rubrique_child['id']])->count();
                    $childs[] = [
                        'id' => $rubrique_child['id'],
                        'label' => $rubrique_child['name'],
                        'count' => $count,
                    ];

                    $countFiches += $count;
                }
                if ($childs) {
                    $rubriquesNest[] = [
                        'id' => $rubrique['id'],
                        'label' => $rubrique['name'],
                        'rappel' => $rubrique['first_rubrique'],
                        'count' => $countFiches,
                        'children' => $childs,
                    ];
                } else {
                    $rubriquesNest[] = [
                        'id' => $rubrique['id'],
                        'label' => $rubrique['name'],
                        'rappel' => $rubrique['first_rubrique'],
                        'count' => Fiche::whereIn('qualif_mutu_id', [$rubrique['id']])->count(),
                        'children' => [],
                    ];
                }
            } elseif (!$rubrique['show_menu'] && count($children) > 0) {

                foreach ($children as $rubrique_child) {
                    if (!$rubrique_child['show_menu'])
                        continue;
                    $rubriquesNest[] = [
                        'id' => $rubrique_child['id'],
                        'label' => $rubrique_child['name'],
                        'rappel' => $rubrique['first_rubrique'],
                        'count' => Fiche::whereIn('qualif_mutu_id', [$rubrique['id']])->count(),
                        'children' => [],
                    ];
                }
            }
        }
        return response()->json([
            'rubriques' => $rubriquesNest,
        ]);
    }

    public function destroy($id)
    {

        $statut = Slide::find($id);
        $statut->delete();

        return true;
        //return redirect('/types')->with('success', 'Slide deleted!');
    }
}
