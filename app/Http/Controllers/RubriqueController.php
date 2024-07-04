<?php

namespace App\Http\Controllers;

use App\Fiche;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Ville;
use App\Rubrique;
use App\User;
use App\Http\Resources\VilleAC as VilleACResource;
use App\Http\Resources\RubriqueAC as RubriqueResource;
use App\Http\Resources\RubriqueServiceOptionnel as ResourcesRubriqueServiceOptionnel;
use App\Http\Resources\RubriqueTree as RubriqueTreeResource;
use App\Http\Resources\ServiceOptionnel;
use App\Http\Resources\ServiceOptionnelAC;
use App\RubriqueQuestion;
use App\RubriqueServiceOptionnel;
use App\ServiceOptionnel as AppServiceOptionnel;
use Illuminate\Support\Str;

class RubriqueController extends Controller
{
    public function index(Request $request)
    {
        $types = [];
        $types[] = ['value' => 'input', 'text' => 'Zone de texte'];
        $types[] = ['value' => 'textarea', 'text' => 'Long texte'];
        $types[] = ['value' => 'datepicker', 'text' => 'Date'];
        $types[] = ['value' => 'liste', 'text' => 'Liste déroulante'];

        $listes = [];
        $listes[] = ['value' => 'villes', 'text' => 'Liste des villes'];
        $listes[] = ['value' => 'keywords', 'text' => 'Réponses personalisées'];

        $impacts_prix = [];
        $impacts_prix[] = ['value' => 'up', 'text' => 'Augmenter le prix par'];
        //$impacts_prix[] = ['value' => 'down', 'text' => 'Diminuer le prix par'];
        $impacts_prix[] = ['value' => 'fix', 'text' => 'Fixer le prix par'];

        $impacts_delai = [];
        $impacts_delai[] = ['value' => 'up', 'text' => 'Augmenter le délai par'];
        $impacts_delai[] = ['value' => 'down', 'text' => 'Diminuer le délai par'];
        $impacts_delai[] = ['value' => 'fix', 'text' => 'Fixer le délai par'];


        $langues = [];
        $langues[] = ['value' => 'fr', 'text' => 'Français'];
        $langues[] = ['value' => 'en', 'text' => 'Anglais'];
        $langues[] = ['value' => 'ar', 'text' => 'Arabe'];

        $rubriques = [];
        $dataTree = [];

        $times = [];
        for ($i = 1; $i <= 30; $i++) {
            $times[] =
                ['value' => $i, 'text' => ($i == 1) ? '24 Heures' : $i . ' jours'];
        }

        if ($request->get('specific')) {
            $dataTree = RubriqueTreeResource::collection(Rubrique::where('secteur',  false)->whereNotNull('parent_id')->orderBy('ordre')->get());
            $rubriques = RubriqueResource::collection(Rubrique::where('secteur',  false)->whereNotNull('parent_id')->orderBy('ordre')->get());
        } else {
            $dataTree = RubriqueTreeResource::collection(Rubrique::where('secteur',  true)->whereNull('parent_id')->orderBy('ordre')->get());
            $rubriques = RubriqueResource::collection(Rubrique::where('secteur',  true)->whereNull('parent_id')->orderBy('ordre')->get());
        }


        return response()->json([
            'dataTree' => $dataTree,
            'rubriques' => $rubriques,
            'times' => $times,
            'types' => $types,
            'impacts_prix' => $impacts_prix,
            'impacts_delai' => $impacts_delai,
            'langues' => $langues,
            'listes' => $listes
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
            $statut = Rubrique::find($item['id']);
            $statut->ordre = $ordre;
            $statut->save();
            $ordre++;

            foreach ($item['children'] as $item_child) {
                $statut_child = Rubrique::find($item_child['id']);
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
        $langues[] = ['value' => 'fr', 'text' => 'Français'];
        $langues[] = ['value' => 'en', 'text' => 'Anglais'];
        $langues[] = ['value' => 'ar', 'text' => 'Arabe'];

        $rules = [];

        $rules['text_fr'] = 'required_if:text_en,""';
        $rules['text_en'] = 'required_if:text_fr,""';

        if ($request->get('id') && $request->get('id') != 'null') {
            $statut = Rubrique::find($request->get('id'));
        } else {
            $statut = new Rubrique();
        }

        $questions = json_decode($request->get('questions'), true);

        $validte = $request->validate($rules);
        if ($validte) {

            $statut->secteur = $request->get('specific') ? false : true;
            foreach ($langues as $lang) {
                $statut->setTranslation('label', $lang['value'], $request->get('text_' . $lang['value']) ? str_replace('"', "'", $request->get('text_' . $lang['value'])) : null);
                $statut->setTranslation('presentation', $lang['value'], $request->get('presentation_' . $lang['value']) ? str_replace('"', "'", $request->get('presentation_' . $lang['value'])) : null);
                $statut->setTranslation('description', $lang['value'], $request->get('description_' . $lang['value']) ? str_replace('"', "'", $request->get('description_' . $lang['value'])) : null);
            }

            $statut->alias = Str::slug($statut->label);
            $statut->color =  ($request->get('color') != 'null') ? $request->get('color') : null;
            $statut->codif =  ($request->get('codif') != 'null') ? $request->get('codif') : null;
            $statut->montant =  ($request->get('montant') != 'null') ? $request->get('montant') : null;
            $statut->time_to_deliver =  ($request->get('time_to_deliver') != 'null' && $request->get('time_to_deliver') != 'undefined') ? $request->get('time_to_deliver') : null;
            $statut->parent_id =  ($request->get('parent_id') != 'null') ? $request->get('parent_id') : null;
            $statut->enable =  ($request->get('enable') === 'true' || $request->get('enable') === '1') ? true : false;
            $statut->show_menu =  ($request->get('show_menu') === 'true' || $request->get('show_menu') === '1') ? true : false;
            $statut->show_calendar =  ($request->get('show_calendar') === 'true' || $request->get('show_calendar') === '1') ? true : false;
            if (($request->get('first_rubrique') === 'true' || $request->get('first_rubrique') === '1')) {
                Rubrique::where('secteur', 1)->update(['first_rubrique' => false]);
                $statut->first_rubrique =  true;
            }
            if ($request->hasFile('icon')) {
                $imageName = time() . '.' . $request->file('icon')->extension();
                $path = $request->file('icon')->storeAs(
                    'rubriques',
                    $imageName
                );
                $statut->icon = $imageName;
            }
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->file('image')->extension();
                $path = $request->file('image')->storeAs(
                    'rubriques',
                    $imageName
                );
                $statut->image = $imageName;
            }

            if ($request->get('specific')) {
                $parentSpecific = Rubrique::where('secteur', false)->whereNull('parent_id')->first();
                if ($parentSpecific) {
                    $statut->parent_id =  $parentSpecific->id;
                }
            }

            $statut->save();

            $index = 1;
            if ($questions)
                foreach ($questions as $item) {
                    $question = RubriqueQuestion::find($item['id']);
                    $question->rubrique_id =  $statut->id;
                    $question->ordre =  $index;
                    $question->save();
                    $index++;
                }


            if ($statut->save()) {
                return new $statut;
            }
        } else {
        }

        //return redirect('/types')->with('success', 'Rubrique saved!');
    }

    public function service_optionnel(Request $request)
    {
        $rules = [
            'service_id' => 'required'
        ];

        if ($request->get('id') && $request->get('id') != 'null') {
            $service_optionnel = RubriqueServiceOptionnel::find($request->get('id'));
        } else {
            $service_optionnel = new RubriqueServiceOptionnel();
        }

        $validte = $request->validate($rules);
        if ($validte) {

            $service_optionnel->service_id =  ($request->get('service_id') && $request->get('service_id') != 'null') ? $request->get('service_id') : null;
            $service_optionnel->rubrique_id =  ($request->get('rubrique_id') && $request->get('rubrique_id') != 'null') ? $request->get('rubrique_id') : null;
            $service_optionnel->impact_montant_type =  ($request->get('impact_montant_type') && $request->get('impact_montant_type') != 'null') ? $request->get('impact_montant_type') : null;
            $service_optionnel->impact_montant_valeur =  ($request->get('impact_montant_valeur') && $request->get('impact_montant_valeur') != 'null') ? $request->get('impact_montant_valeur') : null;
            $service_optionnel->impact_delai_type =  ($request->get('impact_delai_type') && $request->get('impact_delai_type') != 'null') ? $request->get('impact_delai_type') : null;
            $service_optionnel->impact_delai_valeur =  ($request->get('impact_delai_valeur') && $request->get('impact_delai_valeur') != 'null') ? $request->get('impact_delai_valeur') : null;
            $service_optionnel->save();

            return response()->json([
                'service_optionnel' => $service_optionnel ? ResourcesRubriqueServiceOptionnel::collection([$service_optionnel])[0] : null,
            ]);
        } else {
        }

        //return redirect('/questions')->with('success', 'Question saved!');
    }

    public function delete_service_optionnel($id)
    {

        $service_optionnel = RubriqueServiceOptionnel::find($id);
        $service_optionnel->delete();

        return true;
        //return redirect('/questions')->with('success', 'Question deleted!');
    }

    public function show($id)
    {
        $types = Rubrique::where('parent_id', $id)->get();
        return $types;
    }

    public function edit($id)
    {
        $statut = Rubrique::find($id);
        return view('types.form', compact('statut'));
    }

    public function menu_admin(Request $request)
    {
        $rubriquesNest = [];
        $rubriques = RubriqueTreeResource::collection(Rubrique::where('secteur', 1)->whereNull('parent_id')->orderBy('ordre')->get())->toArray([]);

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

        $statut = Rubrique::find($id);
        $statut->delete();

        return true;
        //return redirect('/types')->with('success', 'Rubrique deleted!');
    }
}
