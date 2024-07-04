<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


use App\Http\Resources\BonRetour as BonRetourResource;
use App\Http\Resources\Boxe as BoxeResource;
use App\BonRetour;
use App\Boxe;

class HomeMngrController extends Controller
{
    public function index(Request $request)
    {
        $user = $this->guard()->user();
        $professeur = $user->professeur;

        if (!$professeur)
            exit;

        \Carbon\Carbon::setLocale('en');
        $date = $request->get('date') ? $request->get('date') : date('Y-m-d');

        $ids = array(13, 4, 9, 11, 14, 6);
        $ids_ordered = implode(',', $ids);

        $statuts_filter = ColisStatut::whereIn('id', $ids)
            ->orderByRaw("FIELD(id, $ids_ordered)")
            ->get();

        $statuts = (ColisStatut::whereIn('id', [4, 6, 8, 9, 10, 11, 14])->get());

        $current_statut = $request->get('statut_id') ? ColisStatut::find($request->get('statut_id')) : null;
        if ($current_statut)
            $colis = Colis::where(function ($query) use ($current_statut, $professeur) {
                $query->where('statut_id', $current_statut->id);
                //$query->where('professeur_id', $professeur->id)->orWhereNull('professeur_id');
            })->orderBy('created_at')->get();

        $boxe = $request->get('boxe_id') ? Boxe::find($request->get('boxe_id')) : null;
        if ($boxe)
            $colis = $boxe->colis;

        $dashboard = [];

        $dashboard[] = [
            'icon' => 'checkbox-outline',
            'label' => 'Colis livrés <br /> Aujourd\'hui',
            'value' => Colis::whereDate('created_at', 'like', date('Y-m') . '%')->where('statut_id', '=', 4)->count()
        ];
        $dashboard[] = [
            'icon' => 'cash-outline',
            'label' => 'Montant colis <br /> livrés Aujourd\'hui',
            'value' => number_format(Colis::whereDate('created_at', 'like', date('Y-m') . '%')->where('statut_id', '=', 4)->get()->sum->prix, 2)
        ];

        $dashboard[] = [
            'icon' => 'cube-outline',
            'label' => 'Colis livrés <br /> ce mois',
            'value' => Colis::whereDate('created_at', 'like', date('Y-m') . '%')->where('statut_id', '=', 4)->count()
        ];
        /*

        $dashboard[] = [
            'icon' => 'people-outline',
            'label' => 'Réservations',
            'value' => ($user->role_id == 2) ? Colis::whereDate('date', '=', $date)->whereNotIn('statut_id', [3, 4])->orderBy('date')->count() : Colis::whereDate('date', '=', $date)->where('professeur_id', $professeur->id)->whereNotIn('statut_id', [3, 4])->orderBy('date')->count()
        ];

        $dashboard[] = [
            'icon' => 'star-half-outline',
            'label' => 'Notations',
            'value' => ($user->role_id == 2) ? Colis::whereHas('prestations', function ($query) use ($date) {
                $query->whereDate('notation_date', '=', $date);
            })->count() : Colis::whereHas('prestations', function ($query) use ($date) {
                $query->whereDate('notation_date', '=', $date);
            })->where('professeur_id', $professeur->id)->count()
        ];
        */

        setlocale(LC_TIME, 'French');

        $sub_title = \Carbon\Carbon::parse($date)->translatedFormat('d F Y');
        if ($current_statut)
            $sub_title = $current_statut->label;
        if ($boxe)
            $sub_title = 'Boxe N° ' . $boxe->code;


        //$agence = AgenceScope::$agence;
        $data = [
            'logo' => '',
            'title' => 'Bonjour, ' . $user->prenom,
            'statut_id' => $current_statut ? $current_statut->id : null,
            'show_menu' => ($current_statut || $boxe) ? false : true,
            'colis' => isset($colis) ? ColisResource::collection($colis) : null,
            'sub_title' => $sub_title,
            'statuts' => ColisStatutAC::collection($statuts),
            'no_data_label' => 'Vous n\'avez aucun colis pour avec ce statut.',
            'no_data_img' => 'https://image.flaticon.com/icons/svg/202/202381.svg',
            'statuts_filter' => $statuts_filter,
            'dashboard' => $dashboard,
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

    public function br(Request $request)
    {
        $user = $this->guard()->user();
        $professeur = $user->professeur;

        $colis = Colis::where(function ($query) use ($professeur) {
            $query->doesntHave('bon_retour_professeur');
            $query->whereIn('statut_id', [6, 8, 9, 10, 11]);
            //$query->where('professeur_id', $professeur->id)->orWhereNull('professeur_id');
        })->orderBy('created_at')->get();

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


    public function fcm_token(Request $request)
    {
        $user = $this->guard()->user();
        $professeur = $user ? $user->professeur : null;

        $fcmToken = FcmToken::where(function ($query) use ($professeur, $request) {
            $query->where('token', $request->get('token'));
            if ($professeur) {
                $query->orWhere('professeur_id', $professeur->id);
            }
        })->first();

        if (!$fcmToken)
            $fcmToken = new FcmToken();
        $fcmToken->professeur_id =  ($professeur) ? $professeur->id : null;
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
        $colis->date_report =  $request->get('date_report') ? $request->get('date_report') : null;
        $colis->save();

        if (true) {
            $traking = new ColisTraking();
            $traking->statut_id =  $statut_id;
            $traking->colis_id =  $colis->id;
            $traking->commentaire =  $request->get('commentaire');
            $traking->date_report =  $request->get('date_report') ? $request->get('date_report') : null;
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



    public function submit_br(Request $request)
    {

        $user = $this->guard()->user();
        $professeur = $user->professeur;

        $colisJson = $request->get('colis');;

        $bon_retour = new BonRetour();
        $bon_retour->code =  strtoupper(Str::random(10));
        $bon_retour->statut_id = 1;
        $bon_retour->professeur_id =  $professeur->id;
        $bon_retour->save();

        $bon_retour->colis_professeur()->sync($colisJson ? $colisJson : []);

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



    public function bons_retour()
    {

        $user = $this->guard()->user();
        $professeur = $user->professeur;

        $bons_retour = BonRetour::where(function ($query) use ($professeur) {
            $query->where('professeur_id', $professeur->id);
        })->orderBy('created_at')->get();


        $data = [
            'title' => 'Bonjour, ' . $user->prenom,
            'sub_title' => 'Bons de retour',
            'no_data_label' => 'Vous n\'avez aucun bon de retour pour le moment.',
            'no_data_img' => 'https://image.flaticon.com/icons/svg/202/202381.svg',
            'bons_retour' => BonRetourResource::collection($bons_retour),
        ];
        return [
            'status' => '200',
            'data' => json_encode($data),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none'
        ];
    }

    public function boxes()
    {

        $user = $this->guard()->user();
        $professeur = $user->professeur;

        $boxes = Boxe::where(function ($query) use ($professeur) {
            $query->where('destinataire_id', $professeur->id);
            $query->where('destinataire_type', 'App\Professeur');
        })->orderBy('created_at')->get();


        $data = [
            'title' => 'Bonjour, ' . $user->prenom,
            'sub_title' => 'Mes Boxes',
            'no_data_label' => 'Vous n\'avez aucun boxe pour le moment.',
            'no_data_img' => 'https://image.flaticon.com/icons/svg/202/202381.svg',
            'boxes' => BoxeResource::collection($boxes),
        ];
        return [
            'status' => '200',
            'data' => json_encode($data),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none'
        ];
    }

    public function search_boxe(Request $request)
    {

        $user = $this->guard()->user();
        $professeur = $user->professeur;

        $boxe = Boxe::where(function ($query) use ($professeur, $request) {
            $query->where('code', $request->get('qr_code'));
        })->orderBy('created_at')->first();

        if ($boxe) {
            if ($request->get('save') == true && $boxe->statut_id != 4) {
                foreach ($boxe->colis as $item) {
                    $item->statut_id = 13;
                    $item->save();

                    $traking = new ColisTraking();
                    $traking->statut_id =  $item->statut_id;
                    $traking->colis_id =  $item->id;
                    $traking->user_id =  $user->id;
                    $traking->save();
                }

                $boxe->statut_id = 4;
                $boxe->save();
            }
            $data = [
                'error' => false,
                'title' => 'Marquer le boxe comme en cours de livraison !',
                'message' => 'Une fois cliqué sur en cours de livraison, le statut de boxe sera changé à En cours de livraison.',
            ];
        } else {
            $data = [
                'error' => true,
                'title' => 'Boxe introuvable !',
                'message' => 'Désolé ! Le boxe avec le code ' . $request->get('qr_code') . ' n\'existe pas',
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
        $professeur = $user->professeur;

        $colis_item = Colis::where(function ($query) use ($professeur, $request) {
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
                'title' => 'Boxe introuvable !',
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


    public function save_creneau(Request $request)
    {

        $user = $this->guard()->user();
        $professeur = $user->professeur;

        $argument = [];
        if ($request->get('id')) {
            $argument['id'] = $request->get('id');
            $professeurCalendar = ProfesseurCalendrier::firstOrNew($argument);
        } else {
            $professeurCalendar = new ProfesseurCalendrier;
        }

        if ($request->get('supprimer')) {
            $professeurCalendar->delete();
        } else {
            $professeurCalendar->heure_debut = $request->get('start');
            $professeurCalendar->heure_fin = $request->get('end');
            $professeurCalendar->actif = $request->get('actif');
            $professeurCalendar->professeur_id = $professeur->id;
            $professeurCalendar->jour = $request->get('day');
            $professeurCalendar->save();
        }

        $data = [];
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
            'image' => asset('/storage/splash/manager/1.svg'),
            'title' => 'SDC Partner',
            'description' => 'Partenaire des e-commerçants depuis de plusieurs années, skerlingo s’adapte aux évolutions du marché e-commerce au Maroc.',
        ];

        $slides[] = [
            'image' => asset('/storage/splash/manager/2.svg'),
            'title' => 'Service efficace',
            'description' => 'Partenaire des e-commerçants depuis de plusieurs années, skerlingo s’adapte aux évolutions du marché e-commerce au Maroc.',
        ];

        $slides[] = [
            'image' => asset('/storage/splash/manager/2.svg'),
            'title' => 'SDC Partner',
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
