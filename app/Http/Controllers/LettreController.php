<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Lettre;
use App\User;
use App\Http\Resources\Lettre as LettreResource;
use App\Imports\ImportDescriptions;
use App\Imports\ImportExemple;
use App\LettreExemple;
use Maatwebsite\Excel\Facades\Excel;

class LettreController extends Controller
{
    public function index(Request $request)
    {


        $langues = [];
        $langues[] = ['value' => 'en', 'text' => 'Anglais'];
        $langues[] = ['value' => 'fr', 'text' => 'Français'];

        $types = [];
        $types[] = ['value' => 'hiragana', 'text' => 'Hiragana'];
        $types[] = ['value' => 'katakana', 'text' => 'Katakana'];

        return response()->json([
            'rubriques' => LettreResource::collection(Lettre::where('type', $request->get('type'))->get()),
            'langues' => $langues,
            'types' => $types
        ]);
    }

    public function create()
    {
        $temoignage = null;
        return view('rubriques.form', compact('temoignage'));
    }

    public function update_descriptions(Request $request)
    {

        $path = $request->file('file');

        $dataExcel = Excel::toArray(new ImportDescriptions, $path);


        if ($request->get('upload_type') == 'title_hiragana') {
            foreach ($dataExcel[0] as $key => $item) {

                if (!$item[1])
                    continue;


                $labelLettre = ucfirst(strtolower($item[1]));
                $lettre = Lettre::where(function ($query) use ($labelLettre) {
                    $query->where('romaji', $labelLettre);
                    $query->where('type', 'hiragana');
                })->first();

                if (!$lettre) {
                    $lettre = new Lettre();
                    $lettre->romaji = $item[1];
                    $lettre->kana = $item[2];
                    $lettre->type = 'hiragana';
                }

                if (true) {
                    $lettre->group = $item[0];
                    $lettre->setTranslation('label', 'en', $item[3]);
                    $lettre->setTranslation('label', 'fr', $item[4]);

                    $lettre->save();
                }
            }
        } elseif ($request->get('upload_type') == 'description_hiragana') {
            foreach ($dataExcel[0] as $key => $item) {

                if (!$item[1])
                    continue;


                $labelLettre = ucfirst(strtolower($item[1]));
                $lettre = Lettre::where(function ($query) use ($labelLettre) {
                    $query->where('romaji', $labelLettre);
                    $query->where('type', 'hiragana');
                })->first();

                if ($lettre) {

                    $descriptionEn = '';
                    $descriptionEnArr = explode("<br>", $item[4]);
                    foreach ($descriptionEnArr as $itemArr) {
                        $descriptionEn .= '<p>' . $itemArr . '</p>';
                    }

                    $descriptionFr = '';
                    $descriptionFrArr = explode("<br>", $item[3]);
                    foreach ($descriptionFrArr as $itemArr) {
                        $descriptionFr .= '<p>' . $itemArr . '</p>';
                    }

                    $lettre->setTranslation('description', 'en', $descriptionEn);
                    $lettre->setTranslation('description', 'fr', $descriptionFr);

                    $lettre->save();
                }
            }
        } elseif ($request->get('upload_type') == 'exemples_hiragana') {

            if (true) {

                $lettre = null;
                foreach ($dataExcel[0] as $key => $item) {

                    //dd($item);

                    if (!$item[6])
                        continue;

                    if ($item[0]) {
                        $labelLettre = ucfirst(strtolower($item[0]));
                        $lettre = Lettre::where(function ($query) use ($labelLettre) {
                            $query->where('romaji', $labelLettre);
                            $query->where('type', 'hiragana');
                        })->first();

                        $lettre->exemples()->delete();
                    }

                    if (!$lettre)
                        continue;


                    $lettreExemple = new LettreExemple();
                    $lettreExemple->kana = $item[6];
                    $lettreExemple->prononciation = $item[7];
                    $lettreExemple->romaji = $item[8];
                    $lettreExemple->lettre_id = $lettre->id;
                    $lettreExemple->type = 'hiragana';

                    $lettreExemple->setTranslation('label', 'en', $item[9]);
                    $lettreExemple->setTranslation('label', 'fr', $item[10]);

                    $lettreExemple->save();
                }
            }
        } elseif ($request->get('upload_type') == 'exemples_hiragana') {

            if (true) {

                $lettre = null;
                foreach ($dataExcel[0] as $key => $item) {

                    //dd($item);

                    if (!$item[6])
                        continue;

                    if ($item[0]) {
                        $labelLettre = ucfirst(strtolower($item[0]));
                        $lettre = Lettre::where(function ($query) use ($labelLettre) {
                            $query->where('romaji', $labelLettre);
                            $query->where('type', 'katakana');
                        })->first();

                        $lettre->exemples()->delete();
                    }

                    if (!$lettre)
                        continue;


                    $lettreExemple = new LettreExemple();
                    $lettreExemple->kana = $item[6];
                    $lettreExemple->prononciation = $item[7];
                    $lettreExemple->romaji = $item[8];
                    $lettreExemple->lettre_id = $lettre->id;
                    $lettreExemple->type = 'katakana';

                    $lettreExemple->setTranslation('label', 'en', $item[9]);
                    $lettreExemple->setTranslation('label', 'fr', $item[10]);

                    $lettreExemple->save();
                }
            }
        }

        return response()->json([]);
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
            $temoignage = Lettre::find($request->get('id'));
        } else {
            $temoignage = new Lettre();
        }

        $niceNames = array(
            'text_fr' => '<< Title en français  >>',
            'text_en' => '<< Title en anglais >>',
        );

        $validte = $request->validate($rules, [], $niceNames);
        if ($validte) {

            $temoignage->romaji =  $request->get('romaji');
            $temoignage->kana =  $request->get('kana');
            foreach ($langues as $lang) {
                $temoignage->setTranslation('label', $lang['value'], $request->get('text_' . $lang['value']) ? str_replace('"', "'", $request->get('text_' . $lang['value'])) : null);
                $temoignage->setTranslation('description', $lang['value'], $request->get('description_' . $lang['value']) ? str_replace('"', "'", $request->get('description_' . $lang['value'])) : null);
            }

            $temoignage->save();

            if ($temoignage->save()) {
                return new $temoignage;
            }
        } else {
        }

        //return redirect('/rubriques')->with('success', 'Lettre saved!');
    }

    public function show($id)
    {
        $rubriques = Lettre::where('parent_id', $id)->get();
        return $rubriques;
    }

    public function edit($id)
    {
        $temoignage = Lettre::find($id);
        return view('rubriques.form', compact('temoignage'));
    }

    public function destroy($id)
    {

        $temoignage = Lettre::find($id);
        $temoignage->delete();

        return true;
        //return redirect('/rubriques')->with('success', 'Lettre deleted!');
    }
}
