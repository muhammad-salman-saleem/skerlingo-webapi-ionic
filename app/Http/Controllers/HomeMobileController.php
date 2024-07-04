<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Scopes\AgenceScope;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Http\Resources\PrestationCategorie as PrestationCategorieResource;
use App\Http\Resources\Prestation as PrestationResource;
use App\Http\Resources\Professeur as ProfesseurResource;
use App\Http\Resources\Colis as ColisResource;
use App\Http\Resources\Client as ClientResource;
use App\Http\Resources\Produit as ProduitResource;
use App\Http\Resources\Agence as AgenceResource;
use App\Http\Resources\Giveaway  as GiveawayResource;
use App\Professeur;
use App\PrestationCategorie;
use App\Prestation;
use App\Commande;
use App\ProfesseurCalendrier;
use App\Giveaway;
use App\FcmToken;
use App\GiveawayParticipation;
use Illuminate\Support\Facades\DB;

use App\Http\Resources\BonLivraison as BonLivraisonResource;
use App\Http\Resources\Facture as FactureResource;
use App\BonLivraison;
use App\Facture;

use App\ClientRamassageAdresse;
use App\Agence;
use App\AppConfig;
use App\Colis;
use App\ColisStatut;
use App\Ville;
use App\Quartier;
use App\User;
use App\ColisTraking;
use App\Http\Resources\VilleAC as VilleACResource;
use App\Http\Resources\PointRelaisAC as PointRelaisACResource;
use App\Http\Resources\QuartierAC as QuartierACResource;
use App\Http\Resources\AgenceAC as AgenceACResource;
use App\Http\Resources\ColisForm as ColisFormResource;
use App\Http\Resources\ColisStatutAC;
use App\Http\Resources\ColisTraking as ColisTrakingResource;
use App\Http\Resources\ClientRamassageAdresse as ClientRamassageAdresseResource;
use App\PointRelais;

use App\Client;
use App\Favorite;
use App\Http\Resources\ClientAC as ClientACResource;
use App\Http\Resources\Favorite as ResourcesFavorite;
use App\Http\Resources\Lecon as ResourcesLecon;
use App\Http\Resources\LeconGrid;
use App\Http\Resources\LeconProgress;
use App\Http\Resources\Lettre as ResourcesLettre;
use App\Http\Resources\LettreGrid;
use App\Produit;
use App\Partenaire;
use App\Http\Resources\PartenaireAC as PartenaireACResource;
use App\Lecon;
use App\Lettre;
use App\LettreExemple;
use App\QuizLettre;

class HomeMobileController extends Controller
{
    public function index(Request $request)
    {

        $data = [
            'approche' => ResourcesLecon::collection(Lecon::where('id', 31)->get())[0]
        ];
        return [
            'status' => '200',
            'data' => json_encode($data),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none'
        ];
    }

    public function colis(Request $request)
    {
        $user = $this->guard()->user();
        $client = $user->client;

        \Carbon\Carbon::setLocale('en');
        $date = $request->get('date') ? $request->get('date') : date('Y-m-d');

        $ids = array(1, 2, 3, 13, 4, 9, 11, 5, 6);
        $ids_ordered = implode(',', $ids);

        $statuts_filter = ColisStatut::whereIn('id', $ids)
            ->orderByRaw("FIELD(id, $ids_ordered)")
            ->get();

        $statuts = (ColisStatut::whereIn('id', [4, 6, 8, 9, 10, 11])->get());

        $current_statut = $request->get('statut_id') ? $request->get('statut_id') : null;
        $colis = Colis::where(function ($query) use ($current_statut, $client) {
            if ($current_statut)
                $query->where('statut_id', $current_statut);
            $query->where('client_id', $client->id);
        })->orderBy('created_at', 'desc')->get();

        setlocale(LC_TIME, 'French');


        //$agence = AgenceScope::$agence;
        $data = [
            'logo' => '',
            'title' => 'Bonjour, ' . $user->prenom,
            'statut_id' => $current_statut,
            'colis' => ColisResource::collection($colis),
            'sub_title' => 'Mes colis',
            'statuts' => $statuts,
            'no_data_label' => 'Vous n\'avez aucun colis pour avec ce statut.',
            'no_data_img' => 'https://image.flaticon.com/icons/svg/202/202381.svg',
            'statuts_filter' => $statuts_filter,
            'slide' => 2
        ];
        return [
            'status' => '200',
            'data' => json_encode($data),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none'
        ];
    }


    public function form_colis(Request $request)
    {

        $user = $this->guard()->user();
        $client = $user->client;


        $colis_item = null;
        if ($request->get('id')) {
            $colis_item = Colis::find($request->get('id'));
        } else {
            $colis_item = new Colis();
        }

        $client = $this->guard()->user()->client;
        $adresses = ClientRamassageAdresse::where(function ($query) use ($request, $client) {
            if ($client) {
                $query->where('client_id', $client->id);
            }
        })->get();



        $produits = [];
        if ($request->get('livraison') && $client) {
            $produits = Produit::where(function ($query) use ($request) {
                $query->where('stock', '>', 0);
            })->get();
        }

        $clients = [];
        if (!$client) {
            $clients = Client::where(function ($query) use ($request) {
                $query->whereNotNull('validation_date');
            })->get();
        }



        $data = [
            'title' => 'Bonjour, ' . $user->prenom,
            'sub_title' => 'Ajouter un colis',
            'agences_ramassage' => [],
            'quartiers_ramassage' => [],
            'points_relais_ramassage' => [],
            'agences_livraison' => [],
            'quartiers_livraison' => [],
            'points_relais_livraison' => [],
            'ramassage_ville_choice' => ["agence", "point_relais", "quartier"],
            'markers' => [],
            'position' => [
                'latitude' => null,
                'longitude' => null
            ],
            'frais' => [
                'ramassage' => null,
                'livraison' => null,
                'assurance' => null,
                'emballage' => null,
            ],
            'ville_ramassage' => null,
            'emplacement_ramassage' => null,
            'ville_livraison' => null,
            'emplacement_livraison' => null,
            'colis_item' => $colis_item ? ColisFormResource::collection([$colis_item])[0] : null,
            'adresses' => ClientRamassageAdresseResource::collection($adresses),
            'villes' => VilleACResource::collection(Ville::get()),
            'quartiers' => QuartierACResource::collection(Quartier::get()),
            'points_relais' => PointRelaisACResource::collection(PointRelais::get()),
            'agences' => AgenceACResource::collection(Agence::get()),
            'clients' => !$client ? ClientACResource::collection($clients) : [],
            'produits' => ProduitResource::collection($produits),
        ];
        return [
            'status' => '200',
            'data' => json_encode($data),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none'
        ];
    }

    public function bl(Request $request)
    {
        $user = $this->guard()->user();
        $client = $user->client;

        $colis = Colis::doesntHave('bon_livraison')->where(function ($query) use ($request, $client) {
            if ($client) {
                $query->where('client_id', $client->id);
            }
        })->get();

        $data = [
            'title' => 'Bonjour, ' . $user->prenom,
            'sub_title' => 'Créer un bon',
            'no_data_label' => 'Vous n\'avez aucun colis pour créer un bon de retour.',
            'no_data_img' => 'https://image.flaticon.com/icons/svg/202/202381.svg',
            'colis' => ColisResource::collection($colis),
            'date' => date('Y-m-d'),

        ];

        return [
            'status' => '200',
            'data' => json_encode($data),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none'
        ];
    }

    public function lecons(Request $request)
    {

        $type = $request->get('type');

        session(['locale' => $request->get('lang') ? $request->get('lang') : 'en']);
        app()->setLocale($request->get('lang') ? $request->get('lang') : 'en');

        $user = $this->guard()->user();
        $client = $user ? $user->client : null;

        $data = [];
        if ($type == 'hiragana') {
            $data = [
                'title' => 'Hiragana',
                'description' => 'Choisissez un groupe  et commencer à apprendre les hiraganas !',
                'image_url' => 'assets/hiragana.svg',
                'lecons' => ResourcesLecon::collection(Lecon::where('type', $type)->get())
            ];
        } else {
            $data = [
                'title' => 'Katakana',
                'description' => 'Choisissez un groupe  et commencer à apprendre le katakana !',
                'image_url' => 'assets/katakana.svg',
                'lecons' => ResourcesLecon::collection(Lecon::where('type', $type)->get())
            ];
        }

        return [
            'status' => '200',
            'data' => json_encode($data),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none'
        ];
    }

    public function grid($type)
    {
        $user = $this->guard()->user();
        $client = $user ? $user->client : null;

        $data = [];
        if ($type == 'hiragana') {
            $data = [
                'title' => 'Hiragana',
                'description' => 'Choisissez un groupe  et commencer à apprendre les hiraganas !',
                'image_url' => 'assets/hiragana.svg',
                'lecons' => LeconGrid::collection(Lecon::where('type', $type)->get()),
                'variants' => LettreGrid::collection(Lettre::where('type', 'hiragana')->where('group', 'Variants')->get()),
                'combo' => LettreGrid::collection(Lettre::where('type', 'hiragana')->where('group', 'Combo')->get()),
            ];
        } else {
            $data = [
                'title' => 'Katakana',
                'description' => 'Choisissez un groupe  et commencer à apprendre le katakana !',
                'image_url' => 'assets/katakana.svg',
                'lecons' => LeconGrid::collection(Lecon::where('type', $type)->get()),
                'variants' => LettreGrid::collection(Lettre::where('type', 'katakana')->where('group', 'Variants')->get()),
                'combo' => LettreGrid::collection(Lettre::where('type', 'katakana')->where('group', 'Combo')->get()),
            ];
        }

        return [
            'status' => '200',
            'data' => json_encode($data),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none'
        ];
    }

    public function progress($type)
    {
        $user = $this->guard()->user();
        $client = $user ? $user->client : null;


        $data = [];
        if ($type == 'hiragana') {
            $data = [
                'title' => 'Hiragana',
                'description' => 'Choisissez un groupe et commencer à apprendre les hiraganas !',
                'image_url' => 'assets/hiragana.svg',
                'lecons' => LeconProgress::customCollection(Lecon::where('type', $type)->get(), $user->id),
            ];
        } else {
            $data = [
                'title' => 'Katakana',
                'description' => 'Choisissez un groupe et commencer à apprendre le katakana !',
                'image_url' => 'assets/katakana.svg',
                'lecons' => LeconProgress::customCollection(Lecon::where('type', $type)->get(), $user->id),
            ];
        }

        return [
            'status' => '200',
            'data' => json_encode($data),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none'
        ];
    }

    public function quiz(Request $request)
    {
        $user = $this->guard()->user();
        $client = $user ? $user->client : null;

        $data = [];

        $questions = [];


        $data['quiz_id'] = 'Test';
        $data['label'] = 'Test Label';
        $data['matiere'] = 'Test Matiere';
        $data['color'] = '#000';
        $data['niveau'] = 'Test Niveau';
        $data['image'] = null;
        $minutes = '';
        $countSecond = 0;



        $questions = [];
        $exemples = [];
        if (!$request->get('content')) {
            $questions = Lettre::where(function ($query) use ($request) {
                $query->where('type', $request->get('type'));
                if ($request->get('lecon_id')) {
                    $query->orWhere('lecon_id', $request->get('lecon_id'));
                }
            })->inRandomOrder()->limit(5)->get();
        } elseif ($request->get('content') == 'basic') {
            $questions = Lettre::where(function ($query) use ($request) {
                $query->where('type', $request->get('type'));
                $query->where('group', 'Basics');
                if ($request->get('lecon_id')) {
                    $query->orWhere('lecon_id', $request->get('lecon_id'));
                }
            })->inRandomOrder()->limit(10)->get();
        } elseif ($request->get('content') == 'modified') {
            $questions = Lettre::where(function ($query) use ($request) {
                $query->where('type', $request->get('type'));
                $query->where('group', 'Variants');
                if ($request->get('lecon_id')) {
                    $query->orWhere('lecon_id', $request->get('lecon_id'));
                }
            })->inRandomOrder()->limit(10)->get();
        } elseif ($request->get('content') == 'combo') {
            $questions = Lettre::where(function ($query) use ($request) {
                $query->where('type', $request->get('type'));
                $query->where('group', 'Combo');
                if ($request->get('lecon_id')) {
                    $query->orWhere('lecon_id', $request->get('lecon_id'));
                }
            })->inRandomOrder()->limit(10)->get();
        } elseif ($request->get('content') == 'all') {
            $questions = Lettre::where(function ($query) use ($request) {
                $query->where('type', $request->get('type'));
                if ($request->get('lecon_id')) {
                    $query->orWhere('lecon_id', $request->get('lecon_id'));
                }
            })->inRandomOrder()->limit(10)->get();
        } elseif ($request->get('content') == 'examples') {

            $exemples = LettreExemple::where(function ($query) use ($request) {
                $query->where('type', $request->get('type'));
                if ($request->get('lecon_id')) {
                    $query->whereHas('lettre', function ($query_two) use ($request) {
                        $query_two->where('lecon_id', $request->get('lecon_id'));
                    });
                }
            })->inRandomOrder()->limit($request->get('lecon_id') ? 10 : 10)->get();
        }

        foreach ($questions as $item) {

            $reponses = Lettre::where('id', '!=', $item->id)->where('type', $request->get('type'))->inRandomOrder()->limit(3)->get();

            $reps = array();
            $correct_reponse = '';
            $reps[] = array(
                'reponse' => $item->romaji,
                'kana' => $item->kana,
                'correct' => true,
                'color' => $item->color,
                'illustration' => asset('/assets/mobile/' . $item->type . '/' . $item->type . '_' . $item->romaji . '/' . $item->illustration),
                'illustration_letter' => asset('/assets/mobile/' . $item->type . '/' . $item->type . '_' . $item->romaji . '/' . $item->illustration_letter),
            );
            $correct_reponse = $item->romaji;
            foreach ($reponses as $rep) {
                $reps[] = array(
                    'reponse' => $rep->romaji,
                    'kana' => $rep->kana,
                    'correct' => false,
                    'color' => $rep->color,
                    'illustration' => asset('/assets/mobile/' . $rep->type . '/' . $rep->type . '_' . $rep->romaji . '/' . $rep->illustration),
                    'illustration_letter' => asset('/assets/mobile/' . $rep->type . '/' . $rep->type . '_' . $rep->romaji . '/' . $rep->illustration_letter),
                );
            }

            shuffle($reps);

            $data['questions'][] = array(
                'lettre_id' => $item->id,
                'question' => $item->kana,
                'romaji' => $item->romaji,
                'answer' => array(
                    'answer' => '',
                    'correct' => $correct_reponse,
                    'answered' => null,
                ),
                'image' => null,
                'temps_reponse' => 100,
                'reponses' => $reps,
            );
            $countSecond += 100;
        }

        foreach ($exemples as $item) {

            $reponses = LettreExemple::where('id', '!=', $item->id)->where('type', $request->get('type'))->inRandomOrder()->limit(3)->get();

            $reps = array();
            $correct_reponse = '';
            $reps[] = array(
                'reponse' => $item->label,
                'kana' => $item->kana,
                'correct' => true,
            );
            $correct_reponse = $item->label;
            foreach ($reponses as $rep) {
                $reps[] = array(
                    'reponse' => $rep->label,
                    'kana' => $rep->kana,
                    'correct' => false,
                );
            }

            shuffle($reps);

            $data['questions'][] = array(
                'lettre_id' => $item->lettre_id,
                'question' => $item->kana,
                'romaji' => $item->romaji,
                'answer' => array(
                    'answer' => '',
                    'correct' => $correct_reponse,
                    'answered' => null,
                ),
                'image' => null,
                'temps_reponse' => 100,
                'reponses' => $reps,
            );
            $countSecond += 100;
        }

        $t = round($countSecond);
        $minutes = sprintf('%02d:%02d', ($t / 60 % 60), $t % 60);
        $data['minutes'] = $minutes;
        $data['can_play'] = true;
        $data['can_replay'] = true;

        //Get Random Questions
        shuffle($data['questions']);

        return [
            'status' => '200',
            'data' => json_encode($data),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none'
        ];
    }

    public function lecon(Request $request)
    {

        session(['locale' => $request->get('lang') ? $request->get('lang') : 'en']);
        app()->setLocale($request->get('lang') ? $request->get('lang') : 'en');

        $user = $this->guard()->user();

        $lecon = Lecon::find($request->get('id'));

        $lettres = ResourcesLettre::collection(Lettre::where('lecon_id', $lecon->id)->get());

        $prevLecon = Lecon::where('id', '<', $lecon->id)->where('type', $lecon->type)->whereNotNull('letter')->orderBy('id', 'desc')->first();
        $nextLecon = Lecon::where('id', '>', $lecon->id)->where('type', $lecon->type)->whereNotNull('letter')->orderBy('id', 'asc')->first();

        $data = [
            'lettres' => $lettres,
            'lecon' => ResourcesLecon::collection([$lecon])[0],
            'next_id' => $nextLecon ? $nextLecon->id : null,
            'prev_id' => $prevLecon ? $prevLecon->id : null,
        ];


        $minutes = '';
        $countSecond = 0;

        $nombreQuesions = AppConfig::getConfig(1);
        $nombreExemples = AppConfig::getConfig(2);

        $questions = [];
        $questions = Lettre::where(function ($query) use ($request, $lecon) {
            $query->where('type', $lecon->type);
            $query->where('lecon_id', $lecon->id);
        })->inRandomOrder()->limit($nombreQuesions->value)->get();

        foreach ($questions as $item) {

            $reponses = Lettre::where('id', '!=', $item->id)->where('type', $lecon->type)->inRandomOrder()->limit(3)->get();

            $reps = array();
            $correct_reponse = '';
            $reps[] = array(
                'reponse' => $item->romaji,
                'kana' => $item->kana,
                'correct' => true,
                'color' => $item->color,
                'illustration' => asset('/assets/mobile/' . $item->type . '/' . $item->type . '_' . $item->romaji . '/' . $item->illustration),
                'illustration_letter' => asset('/assets/mobile/' . $item->type . '/' . $item->type . '_' . $item->romaji . '/' . $item->illustration_letter),
            );
            $correct_reponse = $item->romaji;
            foreach ($reponses as $rep) {
                $reps[] = array(
                    'reponse' => $rep->romaji,
                    'kana' => $rep->kana,
                    'correct' => false,
                    'color' => $rep->color,
                    'illustration' => asset('/assets/mobile/' . $rep->type . '/' . $rep->type . '_' . $rep->romaji . '/' . $rep->illustration),
                    'illustration_letter' => asset('/assets/mobile/' . $rep->type . '/' . $rep->type . '_' . $rep->romaji . '/' . $rep->illustration_letter),
                );
            }

            shuffle($reps);

            $data['questions'][] = array(
                'lettre_id' => $item->id,
                'question' => $item->kana,
                'romaji' => $item->romaji,
                'answer' => array(
                    'answer' => '',
                    'correct' => $correct_reponse,
                    'answered' => null,
                ),
                'image' => null,
                'temps_reponse' => 100,
                'reponses' => $reps,
            );
            $countSecond += 100;
        }

        $exemples = LettreExemple::where(function ($query) use ($request, $lecon) {
            $query->where('type', $lecon->type);
            $query->whereHas('lettre', function ($query_two) use ($request, $lecon) {
                $query_two->where('lecon_id', $lecon->id);
            });
        })->inRandomOrder()->limit($nombreExemples->value)->get();


        foreach ($exemples as $item) {

            $reponses = LettreExemple::where('id', '!=', $item->id)->where('type', $lecon->type)->inRandomOrder()->limit(3)->get();

            $reps = array();
            $correct_reponse = '';
            $reps[] = array(
                'reponse' => $item->label,
                'kana' => $item->kana,
                'correct' => true,
            );
            $correct_reponse = $item->label;
            foreach ($reponses as $rep) {
                $reps[] = array(
                    'reponse' => $rep->label,
                    'kana' => $rep->kana,
                    'correct' => false,
                );
            }

            shuffle($reps);

            $data['questions'][] = array(
                'lettre_id' => $item->lettre_id,
                'question' => $item->kana,
                'romaji' => $item->romaji,
                'answer' => array(
                    'answer' => '',
                    'correct' => $correct_reponse,
                    'answered' => null,
                ),
                'image' => null,
                'temps_reponse' => 100,
                'reponses' => $reps,
            );
            $countSecond += 100;
        }

        $t = round($countSecond);
        $minutes = sprintf('%02d:%02d', ($t / 60 % 60), $t % 60);
        $data['minutes'] = $minutes;
        $data['can_play'] = true;
        $data['can_replay'] = true;

        //Get Random Questions
        shuffle($data['questions']);

        return [
            'status' => '200',
            'data' => json_encode($data),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none'
        ];
    }

    public function favorites(Request $request)
    {
        $user = $this->guard()->user();

        $favorites = ResourcesFavorite::collection(Favorite::where('user_id', $user->id)->get());

        $data = [
            'favorites' => $favorites
        ];

        return [
            'status' => '200',
            'data' => json_encode($data),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none'
        ];
    }

    public function favorite(Request $request)
    {

        $user = $this->guard()->user();
        $client = $user->client;


        $favorite = Favorite::where('user_id', $user->id)->where('lecon_id', $request->get('lecon_id'))->where('lettre_id', $request->get('lettre_id'))->first();

        if ($favorite) {
            $favorite->delete();
        } else {

            $favorite = new Favorite();
            $favorite->lecon_id = $request->get('lecon_id');
            $favorite->lettre_id = $request->get('lettre_id');
            $favorite->user_id =  $user->id;
            $favorite->save();
        }

        $data = [];
        return [
            'status' => '200',
            'data' => json_encode($data),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none'
        ];

        //return redirect('/colis')->with('success', 'Colis saved!');
    }


    public function quiz_lettre(Request $request)
    {

        $user = $this->guard()->user();
        $client = $user->client;

        if (!$user) {
            return [
                'status' => '200',
                'data' => json_encode([]),
                'dataSize' => 100,
                'key' => 'test',
                'algo' => 'none'
            ];
        }


        $quiz_lettre = QuizLettre::where('user_id', $user->id)->where('lettre_id', $request->get('lettre_id'))->first();

        if (!$quiz_lettre) {
            $quiz_lettre = new QuizLettre();
            $quiz_lettre->lettre_id = $request->get('lettre_id');
            $quiz_lettre->user_id = $user->id;
        }

        $quiz_lettre->nombre += 1;
        if ($request->get('correct'))
            $quiz_lettre->correct += 1;
        else
            $quiz_lettre->wrong += 1;

        $quiz_lettre->pct = ($quiz_lettre->correct * 100) / $quiz_lettre->nombre;

        $quiz_lettre->save();

        $data = [];
        return [
            'status' => '200',
            'data' => json_encode($data),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none'
        ];

        //return redirect('/colis')->with('success', 'Colis saved!');
    }



    public function fcm_token(Request $request)
    {
        $user = $this->guard()->user();
        $client = $user ? $user->client : null;

        $fcmToken = FcmToken::where(function ($query) use ($client, $request) {
            $query->where('token', $request->get('token'));
            if ($client) {
                $query->orWhere('professeur_id', $client->id);
            }
        })->first();

        if (!$fcmToken)
            $fcmToken = new FcmToken();
        $fcmToken->professeur_id =  ($client) ? $client->id : null;
        $fcmToken->token =  $request->get('token');
        $fcmToken->save();

        return [
            'status' => '200',
            'data' => json_encode([]),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none'
        ];
    }

    public function profil(Request $request)
    {

        $user = $this->guard()->user();
        $client = $user->client;

        $nextColis = Colis::where('client_id', $client->id)->where('date', '>=', date('Y-m-d'))->orderBy('date')->first();
        $colis = Colis::where('client_id', $client->id)->orderBy('date')->get();

        $data = [
            'next_colis' => $nextColis ? ColisResource::collection([$nextColis]) : null,
            'colis' => ColisResource::collection($colis),
            'client' => ClientResource::collection([$client])[0]
        ];
        return [
            'status' => '200',
            'data' => json_encode($data),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none'
        ];
    }

    public function save_res(Request $request)
    {

        $user = $this->guard()->user();

        $colis = Colis::find($request->get('colis_item'));
        $statut_id = null;
        if ($colis->statut_id != $request->get('statut'))
            $statut_id = $request->get('statut');

        $colis->statut_id =  $request->get('statut');
        $colis->save();

        if (true) {
            $traking = new ColisTraking();
            $traking->statut_id =  $statut_id;
            $traking->colis_id =  $colis->id;
            $traking->commentaire =  $request->get('commentaire');
            $traking->user_id =  $user->id;

            if ($request->file) {

                $file = str_replace(' ', '+', $request->file);
                $data = base64_decode($file);
                $imageName = time() . '.' . 'jpeg';
                Storage::disk('local')->put('colis_trakings/' . $imageName, $data);

                $traking->file = $imageName;
            }

            $traking->save();
        }


        $data = [];
        return [
            'status' => '200',
            'data' => json_encode($data),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none'
        ];

        //return redirect('/colis')->with('success', 'Colis saved!');
    }



    public function submit_colis(Request $request)
    {

        $user = $this->guard()->user();
        $client = $user->client;

        $rules = [
            'designation' => 'required'
        ];

        if ($request->get('id') && $request->get('id') != 'null') {
            $colis = Colis::find($request->get('id'));
        } else {
            $colis = new Colis();
        }


        $validte = $request->validate($rules);
        if ($validte) {

            if ($client)
                $colis->client_id =  $client->id;
            else
                $colis->client_id =  $request->get('client_id');
            $colis->designation =  $request->get('designation');
            $colis->prix =  $request->get('prix');
            $colis->frais =  $request->get('total_frais');
            $colis->destinataire =  $request->get('nom_complet');
            $colis->tel_destinataire =  $request->get('telephone');
            //$colis->code =  strtoupper(Str::random(10));
            $colis->ouverture_colis =  ($request->get('ouverture_colis') === 'true' || $request->get('ouverture_colis') === '1') ? true : false;
            $colis->colis_fragile =  ($request->get('colis_fragile') === 'true' || $request->get('colis_fragile') === '1') ? true : false;
            $colis->ramassage_ville_id =  !$request->get('produits_id') ? $request->get('ville_ramassage') : 1;
            $colis->livraison_ville_id =  $request->get('ville_livraison');

            if (!$request->get('produits_id')) {

                $colis->ramassage_id =  $request->get('ramassage_id');
                switch ($request->get('ramassage_type')) {
                    case "agence":
                        $colis->ramassage_type =  'App\Agence';
                        if (!$colis->statut_id)
                            $colis->statut_id =  2;
                        break;
                    case "quartier":
                        $colis->ramassage_type =  'App\Quartier';
                        if (!$colis->statut_id)
                            $colis->statut_id =  1;
                        $colis->ramassage_adresse =  $request->get('ramassage_adresse');
                        break;
                    case "point_relais":
                        if (!$colis->statut_id)
                            $colis->statut_id =  2;
                        $colis->ramassage_type =  'App\PointRelais';
                        break;
                    case "adresse":
                        $clientAdresse = ClientRamassageAdresse::findOrFail($request->get('adresse_id'));
                        if (!$colis->statut_id)
                            $colis->statut_id =  1;
                        $colis->ramassage_ville_id =  $clientAdresse->ville_id;
                        $colis->ramassage_type =  $clientAdresse->ramassage_type;
                        $colis->ramassage_id =  $clientAdresse->ramassage_id;
                        $colis->ramassage_adresse =  $clientAdresse->adresse;
                        break;
                }

                if ($request->get('add_to_favoris') && $request->get('ramassage_type') != 'adresse') {
                    $clientAdresse = new ClientRamassageAdresse();
                    $clientAdresse->ramassage_type =  $colis->ramassage_type;
                    $clientAdresse->ramassage_id =  $colis->ramassage_id;
                    $clientAdresse->adresse =  $colis->ramassage_adresse;
                    $clientAdresse->ville_id =  $colis->ramassage_ville_id;
                    if ($client)
                        $clientAdresse->client_id =  $client->id;
                    else
                        $clientAdresse->client_id =  $request->get('client_id');

                    $clientAdresse->save();
                }
            } else {

                $colis->ramassage_id =  1;
                $colis->ramassage_type =  'App\Agence';
                if (!$colis->statut_id)
                    $colis->statut_id =  2;
            }

            $colis->livraison_id =  $request->get('livraison_id');
            switch ($request->get('livraison_type')) {
                case "agence":
                    $colis->livraison_type =  'App\Agence';
                    break;
                case "quartier":
                    $colis->livraison_type =  'App\Quartier';
                    $colis->livraison_adresse =  $request->get('livraison_adresse');
                    break;
                case "point_relais":
                    $colis->livraison_type =  'App\PointRelais';
                    break;
            }


            if (!$colis->code) {

                $villeRamassage = Ville::findOrFail($colis->ramassage_ville_id);
                $villeLivraison = Ville::findOrFail($colis->livraison_ville_id);

                $colisCount = Colis::where('ramassage_ville_id', $villeRamassage->id)->where('livraison_ville_id', $villeLivraison->id)->whereDate('created_at', date('Y-m-d'))->count();

                $colis->code = $villeRamassage->code . date('d') . str_pad(($colisCount + 1), 3, '0', STR_PAD_LEFT) . date('ym') . $villeLivraison->code;
            }
            $colis->save();

            if ($request->get('produits_id')) {

                $produitsJson = [];
                $prix = 0;
                foreach ($request->get('produits_id') as $key => $item) {


                    $produit = Produit::find($item);

                    $quantiteIndex = array_search($item, array_column($request->get('quantites'), 'produit_id'));

                    $produitsJson[$item] = [
                        'quantite' => $request->get('quantites')[$quantiteIndex]['quantite']
                    ];

                    $produit->stock = $produit->stock - $request->get('quantites')[$quantiteIndex]['quantite'];
                    $produit->save();
                }

                $colis->produits()->sync($produitsJson);
            }

            if (!$colis->code) {
                $traking = new ColisTraking();
                $traking->statut_id =  $colis->statut_id;
                $traking->colis_id =  $colis->id;
                $traking->user_id =  $user->id;
                $traking->save();
            }
        } else {
        }

        $data = ['id' => $colis->id];
        return [
            'status' => '200',
            'data' => json_encode($data),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none'
        ];
    }


    public function submit_bl(Request $request)
    {

        $user = $this->guard()->user();
        $client = $user->client;

        $colisJson = $request->get('colis');;

        $bon_livraison = new BonLivraison();
        $bon_livraison->code =  strtoupper(Str::random(10));
        $bon_livraison->statut_id = 1;
        $bon_livraison->client_id =  $client->id;
        $bon_livraison->save();

        $bon_livraison->colis()->sync($colisJson ? $colisJson : []);

        $data = [];
        return [
            'status' => '200',
            'data' => json_encode($data),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none'
        ];

        //return redirect('/colis')->with('success', 'Colis saved!');
    }



    public function bons_livraison()
    {

        $user = $this->guard()->user();
        $client = $user->client;

        $bons_livraison = BonLivraison::where(function ($query) use ($client) {
            $query->where('client_id', $client->id);
        })->orderBy('created_at')->get();


        $data = [
            'title' => 'Bonjour, ' . $user->prenom,
            'sub_title' => 'Bons de livraison',
            'no_data_label' => 'Vous n\'avez aucun bon de retour pour le moment.',
            'no_data_img' => 'https://image.flaticon.com/icons/svg/202/202381.svg',
            'bons_livraison' => BonLivraisonResource::collection($bons_livraison),
        ];
        return [
            'status' => '200',
            'data' => json_encode($data),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none'
        ];
    }

    public function factures()
    {

        $user = $this->guard()->user();
        $client = $user->client;

        $factures = Facture::where(function ($query) use ($client) {
            //$query->where('professeur_id', $client->id);
        })->orderBy('created_at')->get();


        $data = [
            'title' => 'Bonjour, ' . $user->prenom,
            'sub_title' => 'Mes Factures',
            'no_data_label' => 'Vous n\'avez aucune facture pour le moment.',
            'no_data_img' => 'https://image.flaticon.com/icons/svg/202/202381.svg',
            'factures' => FactureResource::collection($factures),
        ];
        return [
            'status' => '200',
            'data' => json_encode($data),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none'
        ];
    }

    public function contact(Request $request)
    {


        $agence = Agence::find(1);

        $data = AgenceResource::collection([$agence])[0];
        return [
            'status' => '200',
            'data' => json_encode($data),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none'
        ];
    }

    public function search_facture(Request $request)
    {

        $user = $this->guard()->user();
        $client = $user->client;

        $facture = Facture::where(function ($query) use ($client, $request) {
            $query->where('code', $request->get('qr_code'));
        })->orderBy('created_at')->first();



        if ($facture) {
            if ($request->get('save') == true && $facture->statut_id != 4) {
                foreach ($facture->colis as $item) {
                    $item->statut_id = 13;
                    $item->save();

                    $traking = new ColisTraking();
                    $traking->statut_id =  $item->statut_id;
                    $traking->colis_id =  $item->id;
                    $traking->user_id =  $user->id;
                    $traking->save();
                }

                $facture->statut_id = 4;
                $facture->save();
            }
            $data = [
                'error' => false,
                'title' => 'Marquer le facture comme en cours de livraison !',
                'message' => 'Une fois cliqué sur en cours de livraison, le statut de facture sera changé à En cours de livraison.',
            ];
        } else {
            $data = [
                'error' => true,
                'title' => 'Facture introuvable !',
                'message' => 'Désolé ! La facture avec le code ' . $request->get('qr_code') . ' n\'existe pas',
            ];
        }


        return [
            'status' => '200',
            'data' => json_encode($data),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none'
        ];
    }

    public function search_colis(Request $request)
    {

        $user = $this->guard()->user();
        $client = $user->client;

        $colis_item = Colis::where(function ($query) use ($client, $request) {
            $query->where('code', $request->get('qr_code'));
        })->orderBy('created_at')->first();



        if ($colis_item) {

            if ($colis_item->statut_id == 7) {
                $colis_item->statut_id = 13;
                $colis_item->save();
            }
            $data = [
                'error' => false,
                'statut_id' => 13,
                'colis_item' => ColisResource::collection([$colis_item])[0],
            ];
        } else {
            $data = [
                'error' => true,
                'title' => 'Facture introuvable !',
                'message' => 'Désolé ! Le colis avec le code ' . $request->get('qr_code') . ' n\'existe pas',
            ];
        }


        return [
            'status' => '200',
            'data' => json_encode($data),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none'
        ];
    }

    public function splash(Request $request)
    {
        $data = [];
        $slides = [];

        $slides[] = [
            'image' => 'https://dev.asmex.com/assets/site/img/banner-slider/slide_1.jpg',
            'title' => 'skerlingo',
            'description' => 'Partenaire des e-commerçants depuis de plusieurs années, skerlingo s’adapte aux évolutions du marché e-commerce au Maroc.',
        ];

        $slides[] = [
            'image' => 'https://dev.asmex.com/assets/site/img/banner-slider/slide_2.jpg',
            'title' => 'Service efficace',
            'description' => 'Partenaire des e-commerçants depuis de plusieurs années, skerlingo s’adapte aux évolutions du marché e-commerce au Maroc.',
        ];

        $slides[] = [
            'image' => 'https://dev.asmex.com/assets/site/img/services-image/s2.svg',
            'title' => 'skerlingo',
        ];

        $data['slides'] = $slides;

        return [
            'status' => '200',
            'data' => json_encode($data),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none'
        ];

        //return redirect('/colis')->with('success', 'Colis saved!');
    }


    private function guard()
    {
        return Auth::guard();
    }
}
