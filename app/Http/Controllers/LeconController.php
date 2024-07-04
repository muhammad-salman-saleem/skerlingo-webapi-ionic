<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Lecon;
use App\User;
use App\Http\Resources\Lecon as LeconResource;

class LeconController extends Controller
{
    public function index(Request $request)
    {

        $langues = [];
        $langues[] = ['value' => 'en', 'text' => 'Anglais'];
        $langues[] = ['value' => 'fr', 'text' => 'Français'];

        $types = [];
        $types[] = ['value' => 'hiragana', 'text' => 'Hiragana'];
        $types[] = ['value' => 'katakana', 'text' => 'Katakana'];
        $types[] = ['value' => 'content', 'text' => 'Contenu de l\'application'];

        return response()->json([
            'rubriques' => LeconResource::collection(Lecon::where('type', $request->get('type'))->get()),
            'langues' => $langues,
            'types' => $types
        ]);
    }

    public function create()
    {
        $temoignage = null;
        return view('rubriques.form', compact('temoignage'));
    }

    public function store(Request $request)
    {

        $langues = [];
        $langues[] = ['value' => 'en', 'text' => 'Anglais'];
        $langues[] = ['value' => 'fr', 'text' => 'Français'];


        $rules = [];

        $rules['text_fr'] = 'required_if:text_en,""';
        $rules['text_en'] = 'required_if:text_fr,""';

        if ($request->get('id') && $request->get('id') != 'null') {
            $temoignage = Lecon::find($request->get('id'));
        } else {
            $temoignage = new Lecon();
        }

        $niceNames = array(
            'text_fr' => '<< Nom complet en français  >>',
            'text_en' => '<< Nom complet en anglais >>',
        );

        $validte = $request->validate($rules, [], $niceNames);
        if ($validte) {

            $temoignage->letter =  $request->get('letter');
            foreach ($langues as $lang) {
                $temoignage->setTranslation('label', $lang['value'], $request->get('text_' . $lang['value']) ? str_replace('"', "'", $request->get('text_' . $lang['value'])) : null);
                $temoignage->setTranslation('introduction', $lang['value'], $request->get('introduction_' . $lang['value']) ? str_replace('"', "'", $request->get('introduction_' . $lang['value'])) : null);
                $temoignage->setTranslation('description', $lang['value'], $request->get('description_' . $lang['value']) ? str_replace('"', "'", $request->get('description_' . $lang['value'])) : null);
            }

            $temoignage->save();

            if ($temoignage->save()) {
                return new $temoignage;
            }
        } else {
        }

        //return redirect('/rubriques')->with('success', 'Lecon saved!');
    }

    public function show($id)
    {
        $rubriques = Lecon::where('parent_id', $id)->get();
        return $rubriques;
    }

    public function edit($id)
    {
        $temoignage = Lecon::find($id);
        return view('rubriques.form', compact('temoignage'));
    }

    public function destroy($id)
    {

        $temoignage = Lecon::find($id);
        $temoignage->delete();

        return true;
        //return redirect('/rubriques')->with('success', 'Lecon deleted!');
    }
}
