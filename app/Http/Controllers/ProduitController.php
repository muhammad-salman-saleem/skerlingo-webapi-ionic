<?php

namespace App\Http\Controllers;

use App\Banque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Produit as ProduitResource;
use App\Produit;
use App\ClientDocument;
use App\Entreprise;
use App\Http\Resources\ClientDocument as ClientDocumentResource;
use App\ProduitCalendrier;
use App\User;
use App\Http\Resources\RubriqueAC as RubriqueResource;
use App\Ville;
use App\Http\Resources\VilleAC as VilleACResource;
use App\Http\Resources\EntrepriseAC as EntrepriseResource;
use App\Http\Resources\MarqueAC;
use App\Http\Resources\ProduitImage as ProduitImageResource;
use App\Marque;
use App\ProduitCaracteristique;
use App\ProduitImage;
use App\Rubrique;
use Sichikawa\LaravelSendgridDriver\Transport\SendgridTransport;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
use Illuminate\Support\Str;

class ProduitController extends Controller
{

    public function index(Request $request)
    {

        $langues = [];
        $langues[] = ['value' => 'fr', 'text' => 'Français'];

        $villes = [];
        $villes = Ville::get();
        $marques = Marque::get();

        if ($request->get('en_attente')) {
            $produits = ProduitResource::collection(Produit
                ::whereNull('validation_date')->orderBy('created_at', 'desc')->get());
        } else {

            $produits = Produit::where(function ($query) use ($request) {

                if ($request->get('en_attente')) {
                    $query->whereNull('validation_date');
                } else {
                    //$query->whereNotNull('validation_date');
                }

                if ($request->get('type')) {
                    $query->where('type', $request->get('type'));
                }
                if ($request->get('secteur')) {
                    $query->where('secteur_id', $request->get('secteur'));
                }
                if ($request->get('marque')) {
                    $query->where('marque_id', $request->get('marque'));
                }

                if ($request->get('validation_skerlingo')) {
                    if ($request->get('validation_skerlingo') == 'valide') {
                        $query->whereNotNull('validation_skerlingo_date');
                    } else if ($request->get('validation_skerlingo') == 'non_valide') {
                        $query->whereNull('validation_skerlingo_date');
                        $query->whereNull('refus_date');
                    } else if ($request->get('validation_skerlingo') == 'refuse') {
                        $query->whereNotNull('refus_date');
                    }
                }
                if ($request->get('validation_exporteur')) {
                    if ($request->get('validation_exporteur') == 'valide') {
                        $query->whereNotNull('validation_entreprise_date');
                    } else {
                        $query->whereNull('validation_entreprise_date');
                    }
                }
                if ($request->get('ville')) {
                    $query->where('ville_id', $request->get('ville'));
                    /*
                    $query->whereHas('user', function ($query_two) use ($request) {
                        $query_two->where('ville_id', $request->get('ville'));
                    });
                    */
                }
            })->orderBy('created_at', 'desc')->get();
        }

        $types = [
            ['value' => 'non_valide', 'text' => 'En Brouillon'],
            ['value' => 'valide', 'text' => 'Publié'],
        ];

        $types_skerlingo = [
            ['value' => 'non_valide', 'text' => 'A valider'],
            ['value' => 'valide', 'text' => 'Validé'],
            ['value' => 'refuse', 'text' => 'Refusé'],
        ];

        $rubriques_produit = RubriqueResource::collection(Rubrique::where('secteur', 1)->whereNotNull('parent_id')->orderBy('ordre')->get());

        return response()->json([
            'rubriques_produit' => $rubriques_produit,
            'types' => $types,
            'types_skerlingo' => $types_skerlingo,
            'langues' => $langues,
            'produits' => ProduitResource::collection($produits),
            'villes' => $villes ? VilleACResource::collection($villes) : null,
            'marques' => $marques ? MarqueAC::collection($marques) : null,
        ]);
    }

    public function create()
    {
        $produit = null;
        return view('produits.form', compact('produit'));
    }


    public function profile(Request $request)
    {
        $produit = null;
        if ($request->get('id')) {
            $produit = Produit::find($request->get('id'));
        }

        $rubriques = RubriqueResource::collection(Rubrique::where('secteur', 1)->whereNull('parent_id')->orderBy('ordre')->get());

        return response()->json([
            'rubriques' => $rubriques,
            'villes' => VilleACResource::collection(Ville::get()),
            'produit' => $produit ? ProduitResource::collection([$produit])[0] : $produit,
        ]);
    }

    public function store(Request $request)
    {


        $langues = [];
        $langues[] = ['value' => 'en', 'text' => 'Anglais'];
        $langues[] = ['value' => 'fr', 'text' => 'Français'];


        $title = "Le produit / service a été ajouté.";
        $message = "";
        $newProduct = false;
        $user = $this->guard()->user();
        $entreprise = null;

        $caracteristiques = json_decode($request->get('caracteristiques'), true);
        $keywords = json_decode($request->get('keywords'), true);
        $images = json_decode($request->get('images'), true);

        $rules = [
            //'label' => ['required'],
            'secteur_id' => ['required'],
            //'introduction' => ['required'],
        ];
        $rules['label_fr'] = 'required_if:label_en,""';
        $rules['label_en'] = 'required_if:label_fr,""';
        //$rules['introduction_fr'] = 'required_if:introduction_en,""';
        //$rules['introduction_en'] = 'required_if:introduction_fr,""';
        $rules['marque_id'] = ['required'];

        if ($request->get('id') && $request->get('id') != 'null') {
            $produit = Produit::find($request->get('id'));
        } else {
            $produit = new Produit();
            $newProduct = true;
        }

        $niceNames = array(
            'label' => '<< Libellé du produit >>',
            'label_fr' => '<< Nom du produit FR >>',
            'label_en' => '<< Nom du produit EN >>',
            'secteur_id' => '<< Catégorie >>',
            'introduction' => '<< Description rapide >>',
            'introduction_fr' => '<< Description rapide FR >>',
            'introduction_en' => '<< Description rapide EN >>',
            'entreprise_id' => '<< Entreprise >>',
        );

        $validte = $request->validate($rules, [], $niceNames);
        if ($validte) {
            $produit->secteur_id =  $request->get('secteur_id');
            $produit->service =  $request->get('service') == 'oui' ? true : false;
            $produit->marque_id =  $request->get('marque_id');

            foreach ($langues as $lang) {
                $produit->setTranslation('label', $lang['value'], $request->get('label_' . $lang['value']) ? str_replace('"', "'", $request->get('label_' . $lang['value'])) : null);
                $produit->setTranslation('introduction', $lang['value'], $request->get('introduction_' . $lang['value']) ? str_replace('"', "'", $request->get('introduction_' . $lang['value'])) : null);
                $produit->setTranslation('details', $lang['value'], $request->get('details_' . $lang['value']) ? str_replace('"', "'", $request->get('details_' . $lang['value'])) : null);
            }

            //$produit->label =  ($request->get('label') != 'null') ? $request->get('label') : null;
            $produit->keywords =  $keywords ? implode(',', $keywords) : '';
            //$produit->introduction =  ($request->get('introduction') != 'null') ? $request->get('introduction') : null;
            //$produit->details =  ($request->get('details') != 'null') ? $request->get('details') : null;
            $produit->alias = Str::slug($produit->label);

            if (!$produit->creation_user)
                $produit->creation_user = $user->id;

            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->file('image')->extension();
                $path = $request->file('image')->storeAs(
                    'produits',
                    $imageName
                );
                $produit->image = $imageName;
            }

            if ($request->hasFile('fiche')) {
                $ficheName = time() . '.' . $request->file('fiche')->extension();
                $path = $request->file('fiche')->storeAs(
                    'produits',
                    $ficheName
                );
                $produit->fiche = $ficheName;
            }

            $produit->save();


            $idsForm = array_column($caracteristiques, 'id');
            foreach ($produit->caracteristiques as $item) {

                if (!in_array($item->id, $idsForm))
                    $item->delete();
            }


            foreach ($caracteristiques as $item) {
                if (isset($item['id']) && $item['id'])
                    $caracteristique = ProduitCaracteristique::find($item['id']);
                else
                    $caracteristique = new ProduitCaracteristique();

                foreach ($langues as $lang) {

                    if (!isset($item['label_' . $lang['value']]) || !$item['label_' . $lang['value']])
                        continue;

                    $caracteristique->produit_id =  $produit->id;
                    $caracteristique->setTranslation('label', $lang['value'], $item['label_' . $lang['value']] ? str_replace('"', "'", $item['label_' . $lang['value']]) : null);
                    $caracteristique->setTranslation('value', $lang['value'], $item['value_' . $lang['value']] ? str_replace('"', "'", $item['value_' . $lang['value']]) : null);

                    $caracteristique->save();
                }
            }

            if ($images) {

                $indexImage = 0;
                foreach ($images as $item) {
                    $image = ProduitImage::find($item['id']);
                    $image->produit_id =  $produit->id;
                    $image->save();

                    if ($indexImage == 0) {
                        $produit->image = $image->image;
                        $produit->save();
                    }

                    $indexImage++;
                }
            }

            if ($newProduct && $entreprise) {
                $title = "Thanks for adding a new product / service.";
                $message = "";
            }

            return response()->json([
                'title' => $title,
                'message' => $message,
                'produits' => [],
                'produit' => $produit ? ProduitResource::collection([$produit])[0] : $produit,
            ]);
        } else {
        }


        //return redirect('/produits')->with('success', 'Produit saved!');
    }

    public function upload_photo(Request $request)
    {
        $image = new ProduitImage();
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->file('image')->extension();
            $path = $request->file('image')->storeAs(
                'produits',
                $imageName
            );
            $image->image = $imageName;
        }
        $image->produit_id =  $request->get('produit') ? $request->get('produit') : null;

        $image->save();

        return response()->json([
            'image' => $image ? ProduitImageResource::collection([$image])[0] : null,
        ]);

        //return redirect('/produits')->with('success', 'Produit saved!');
    }

    public function delete_photo($id)
    {

        $image = ProduitImage::find($id);
        $image->delete();

        return true;
        //return redirect('/produits')->with('success', 'Produit deleted!');
    }

    public function valider_produit(Request $request)
    {

        $produit = null;
        if ($request->get('id')) {
            $produit = Produit::find($request->get('id'));
        }

        $user = $this->guard()->user();

        if ($request->get('type') == 'asmex') {
            $produit->validation_skerlingo_user =  $user->id;
            $produit->validation_skerlingo_date =  date('Y-m-d H:i:s');
            $produit->refus_date =  null;
            $produit->save();

            //$produit->user->notify(new \App\Notifications\ProductApprovedToExporterNotification($produit));
        }

        $title = null;
        $message = null;

        if ($request->get('type') == 'refus') {
            $produit->refus_user =  $user->id;
            $produit->refus_date =  date('Y-m-d H:i:s');
            $produit->validation_skerlingo_date =  null;
            $produit->save();

            $title = 'Produit refusé';
            $message = 'Le produit a été refusé avec succés.';

            //$produit->user->notify(new \App\Notifications\ProductRefusedToExporterNotification($produit));
        }

        if ($request->get('type') == 'entreprise') {
            $produit->validation_entreprise_user =  $user->id;
            $produit->validation_entreprise_date =  date('Y-m-d H:i:s');
            $produit->save();
        }

        return response()->json([
            'title' => $title,
            'message' => $message,
            'produits' => [],
            'produit' => $produit ? ProduitResource::collection([$produit])[0] : $produit,
        ]);
    }

    public function annuler_produit(Request $request)
    {
        $produit = null;
        if ($request->get('id')) {
            $produit = Produit::find($request->get('id'));
        }

        $title = null;
        $message = null;

        $user = $this->guard()->user();

        if ($request->get('type') == 'asmex') {
            $produit->validation_skerlingo_user =  null;
            $produit->validation_skerlingo_date =  null;
            $produit->save();
        }

        if ($request->get('type') == 'refus') {
            $produit->refus_user =  null;
            $produit->refus_date =  null;
            $produit->save();

            $title = 'Refus annulé';
            $message = 'Le refus a été annulé avec succés.';
        }

        if ($request->get('type') == 'entreprise') {
            $produit->validation_entreprise_user =  null;
            $produit->validation_entreprise_date =  null;
            $produit->save();
        }

        return response()->json([
            'title' => $title,
            'message' => $message,
            'produits' => [],
            'produit' => $produit ? ProduitResource::collection([$produit])[0] : $produit,
        ]);
    }

    public function activer_compte(Request $request)
    {
        $produit = null;
        if ($request->get('id')) {
            $produit = Produit::find($request->get('id'));
        }

        $user = $this->guard()->user();

        $produit->enabled =  true;
        $produit->save();

        $produit->user->enabled =  true;
        $produit->user->save();

        return response()->json([
            'produit' => $produit ? ProduitResource::collection([$produit])[0] : $produit,
        ]);
    }

    public function bloquer_compte(Request $request)
    {
        $produit = null;
        if ($request->get('id')) {
            $produit = Produit::find($request->get('id'));
        }

        $user = $this->guard()->user();

        $produit->enabled =  false;
        $produit->save();

        $produit->user->enabled =  false;
        $produit->user->save();

        return response()->json([
            'produit' => $produit ? ProduitResource::collection([$produit])[0] : $produit,
        ]);
    }

    public function change_password(Request $request)
    {
        $produit = null;
        if ($request->get('id')) {
            $produit = Produit::find($request->get('id'));
        }

        $user = $produit->user;

        $request->validate([
            //'actuel' => ['required', new MatchOldPassword],
            'nouveau' => ['required'],
            'confirmation' => ['same:nouveau'],

        ]);

        $user->password =  Hash::make($request->nouveau);
        $user->save();
        return true;
    }

    public function add_document(Request $request)
    {
        $produit = null;
        if ($request->get('produit_id')) {
            $produit = Produit::find($request->get('produit_id'));
        }
        $user = $this->guard()->user();

        if ($request->hasFile('file')) {
            $imageName = time() . $request->file('file')->extension();
            $path = $request->file('file')->storeAs(
                'client_documents',
                $imageName
            );

            $produitDocument = new ClientDocument();
            $produitDocument->file = $imageName;
            $produitDocument->label = $request->get('label');
            $produitDocument->produit_id = $produit->id;
            $produitDocument->save();
        }

        $documents = ClientDocument::where('produit_id', $produit->id)->get();

        return response()->json([
            'documents' => ClientDocumentResource::collection($documents),
            'produit' => $produit ? ProduitResource::collection([$produit])[0] : $client,
        ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $produit = Produit::find($id);
        return view('produits.form', compact('produit'));
    }

    public function destroy($id)
    {

        $produit = Produit::find($id);
        $produit->delete();

        return true;
        //return redirect('/produits')->with('success', 'Produit deleted!');
    }

    public function calendar($id)
    {
        $days = [];
        $calendar = Produit::find($id)->calendrier;
        foreach ($calendar as $day) {
            $days[] = [
                'id' => $day->id,
                'title' => $day->actif ? 'Disponible' : 'Non disponible',
                'actif' => $day->actif,
                'startTime' => $day->heure_debut,
                'endTime' =>  $day->heure_fin,
                'daysOfWeek' => [$day->jour]
            ];
        }
        return $days;
    }

    public function disponibilite(Request $request)
    {

        $produit = Produit::findOrFail($request->produit);

        $idDays = array_column($request->days, 'id');

        ProduitCalendrier::select("*")
            ->where('produit_id', $produit->id)
            ->whereNotIn('id', $idDays)
            ->delete();

        foreach ($request->days as $day) {

            $argument = [];
            if ($day['id']) {
                $argument['id'] = $day['id'];
                $produitCalendar = ProduitCalendrier::firstOrNew($argument);
            } else {
                $produitCalendar = new ProduitCalendrier;
            }

            $produitCalendar->heure_debut = $day['startTime'];
            $produitCalendar->heure_fin = $day['endTime'];
            $produitCalendar->actif = isset($day['actif']) ? $day['actif'] : true;
            $produitCalendar->produit_id = $produit->id;
            $produitCalendar->jour = $day['daysOfWeek'][0];
            $produitCalendar->save();
        }

        $days = [];
        $calendar = $produit->calendrier;
        foreach ($calendar as $day) {
            $days[] = [
                'id' => $day->id,
                'title' => 'Disponible',
                'startTime' => $day->heure_debut,
                'endTime' =>  $day->heure_fin,
                'daysOfWeek' => [$day->jour]
            ];
        }
        return $days;
    }

    public function competences(Request $request)
    {

        $produit = Produit::findOrFail($request->produit);
        $produit->prestations()->sync($request->get('competences') ? $request->get('competences') : []);

        return [
            'message' => '',
        ];
    }

    private function guard()
    {
        return Auth::guard();
    }
}
