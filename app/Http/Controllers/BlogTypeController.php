<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\BlogType;
use App\User;
use App\Http\Resources\BlogType as BlogTypeResource;

class BlogTypeController extends Controller
{
    public function index(Request $request)
    {

        $langues = [];
        $langues[] = ['value' => 'en', 'text' => 'Anglais'];
        $langues[] = ['value' => 'fr', 'text' => 'Français'];

        return response()->json([
            'rubriques' => BlogTypeResource::collection(BlogType::get()),
            'langues' => $langues
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
            $temoignage = BlogType::find($request->get('id'));
        } else {
            $temoignage = new BlogType();
        }

        $niceNames = array(
            'text_fr' => '<< Nom complet en français  >>',
            'text_en' => '<< Nom complet en anglais >>',
        );

        $validte = $request->validate($rules, [], $niceNames);
        if ($validte) {

            foreach ($langues as $lang) {
                $temoignage->setTranslation('label', $lang['value'], $request->get('text_' . $lang['value']) ? str_replace('"', "'", $request->get('text_' . $lang['value'])) : null);
            }

            $temoignage->save();

            if ($temoignage->save()) {
                return new $temoignage;
            }
        } else {
        }

        //return redirect('/rubriques')->with('success', 'BlogType saved!');
    }

    public function show($id)
    {
        $rubriques = BlogType::where('parent_id', $id)->get();
        return $rubriques;
    }

    public function edit($id)
    {
        $temoignage = BlogType::find($id);
        return view('rubriques.form', compact('temoignage'));
    }

    public function destroy($id)
    {

        $temoignage = BlogType::find($id);
        $temoignage->delete();

        return true;
        //return redirect('/rubriques')->with('success', 'BlogType deleted!');
    }
}
