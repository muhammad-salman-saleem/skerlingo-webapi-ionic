<?php

namespace App\Http\Controllers;

use App\Fiche;
use App\Http\Resources\LangueAC;
use App\Http\Resources\BlogPost as ResourcesBlogPost;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Ville;
use App\Rubrique;
use App\User;
use App\Http\Resources\VilleAC as VilleACResource;
use App\Http\Resources\RubriqueAC as RubriqueResource;
use App\Http\Resources\RubriqueTree as RubriqueTreeResource;
use App\Langue;
use App\BlogPost;
use App\BlogType;
use App\Http\Resources\BlogType as ResourcesBlogType;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    public function index(Request $request)
    {

        $types = [];
        $rubriques = [];
        $dataTree = [];

        $articles = ResourcesBlogPost::collection(BlogPost::get());

        return response()->json([
            'types' => ResourcesBlogType::collection(BlogType::get()),
            'articles' => $articles,
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
            $statut = BlogPost::find($item['id']);
            if ($ordre == 1 && !$statut->secteur)
                $ordre = 1000;
            $statut->ordre = $ordre;
            $statut->save();
            $ordre++;

            foreach ($item['children'] as $item_child) {
                $statut_child = BlogPost::find($item_child['id']);
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


    public function ckeditor_upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('assets/ckeditor'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('assets/ckeditor/' . $fileName);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";


            return response()->json(['url' => $url]);
        }
    }

    public function store(Request $request)
    {

        $rules = [
            'label' => 'required'
        ];


        $niceNames = array(
            'label' => '<< Titre >>',
        );

        if ($request->get('id')) {
            $statut = BlogPost::find($request->get('id'));
        } else {
            $statut = new BlogPost();
        }

        $validte = $request->validate($rules, [], $niceNames);
        if (true) {

            $statut->label = $request->get('label');
            $statut->intro = $request->get('intro');
            $statut->contenu = $request->get('contenu');
            $statut->type_id = $request->get('type_id');
            $statut->alias = Str::slug($statut->label);
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->file('image')->extension();
                $path = $request->file('image')->storeAs(
                    'blog_articles',
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

        //return redirect('/types')->with('success', 'Rubrique saved!');
    }

    public function show($id)
    {
        $types = BlogPost::where('parent_id', $id)->get();
        return $types;
    }

    public function edit($id)
    {
        $statut = BlogPost::find($id);
        return view('types.form', compact('statut'));
    }

    public function menu_admin(Request $request)
    {
        $rubriquesNest = [];
        $rubriques = RubriqueTreeResource::collection(BlogPost::where('secteur', 1)->whereNull('parent_id')->orderBy('ordre')->get())->toArray([]);

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

        $statut = BlogPost::find($id);
        $statut->delete();

        return true;
        //return redirect('/types')->with('success', 'Rubrique deleted!');
    }
}
