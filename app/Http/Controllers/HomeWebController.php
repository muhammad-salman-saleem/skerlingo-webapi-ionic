<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Scopes\AgenceScope;

use App\Http\Resources\PrestationCategorie as PrestationCategorieResource;
use App\Http\Resources\Prestation as PrestationResource;
use App\Http\Resources\Professeur as ProfesseurResource;
use App\Http\Resources\Reservation as ReservationResource;
use App\Http\Resources\Commande as CommandeResource;
use App\Http\Resources\Client as ClientResource;
use App\Http\Resources\Produit as ProduitResource;
use App\Http\Resources\Agence as AgenceResource;
use App\Http\Resources\Giveaway  as GiveawayResource;
use App\Professeur;
use App\PrestationCategorie;
use App\Prestation;
use App\Produit;
use App\AppConfig;
use App\Reservation;
use App\Commande;
use App\User;
use App\Agence;
use App\Giveaway;
use App\FcmToken;
use App\GiveawayParticipation;
use Illuminate\Support\Facades\DB;


class HomeWebController extends Controller
{
    public function index(Request $request)
    {
        $user = $this->guard()->user();

        $agence = AgenceScope::$agence;

        $prestationcategories = PrestationCategorie::whereNull('parent_id')->get();
        $prestations = Prestation::whereNull('categorie_id')->get();
        $offres = Prestation::where('isOnHome', true)->get();
        $giveaway = Giveaway::orderBy('date_debut', 'desc')->first();

        $reservation_eval = null;
        if ($user) {
            $client = $user->client;
            if ($client) {
                $reservation_eval = Reservation::whereHas('prestations', function ($query) use ($client) {
                    $query->whereNull('notation_date');
                    $query->where('client_id', $client->id);
                    $query->where('date', '<=', date('Y-m-d H:i:s'));
                })->orderByDesc('date')->first();
            }
        }

        /*
        foreach ($prestations  as $item) {
            $item->alias = \App\Helpers\Tools::instance()->getAlias($item->label);
            $item->save();
        }
        */

        return response()->json([
            'reservation_eval' => $reservation_eval ? ReservationResource::collection([$reservation_eval])[0] : null,
            'categories' => PrestationCategorieResource::collection($prestationcategories),
            'prestations' => PrestationResource::collection($prestations),
            'offres' => PrestationResource::collection($offres),
            'giveaway' => $giveaway ? GiveawayResource::collection([$giveaway])[0] : null,
            'agence_name' => $agence->label,
            'agence_title' => 'Cher(e)s client(e)s',
            'agence_logo' => $agence->getImage(),
            'banner' => ($agence->metier_id == 1) ? asset('/header-img-h.jpg') : asset('/header-img-f.jpg')
        ]);
    }
    public function services(Request $request)
    {
        //$user = $this->guard()->user();

        $agence = AgenceScope::$agence;

        $prestationcategories = PrestationCategorie::whereNull('parent_id')->get();
        $prestations = Prestation::whereNull('categorie_id')->get();

        $categories = [];
        foreach ($prestationcategories  as $item) {
            $categorie = [
                'categorie' => PrestationCategorieResource::collection([$item])[0],
                'prestations' => PrestationResource::collection(Prestation::where('categorie_id', $item->id)->get())
            ];
            $categories[] = $categorie;
        }

        $linkPlayStore = AppConfig::getConfig(1);
        $linkAppStore = AppConfig::getConfig(2);

        return response()->json([
            'categories' => $categories,
            'agence_name' => $agence->label,
            'app_store' => $linkAppStore ? $linkAppStore->value : '',
            'play_store' => $linkPlayStore ? $linkPlayStore->value : '',
            'prestations' => PrestationResource::collection($prestations)
        ]);
    }

    public function sidebare(Request $request)
    {

        $agence = AgenceScope::$agence;

        return response()->json([
            'agence' => AgenceResource::collection([$agence])[0],
        ]);
    }

    public function agences(Request $request)
    {

        $agence = AgenceScope::$agence;

        $agences = Agence::get();
        $data = [
            'agences' => AgenceResource::collection($agences),
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

        $agence = AgenceScope::$agence;

        $data = AgenceResource::collection([$agence])[0];
        return [
            'status' => '200',
            'data' => json_encode($data),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none'
        ];
    }

    public function categorie($id)
    {

        $categorie = PrestationCategorie::find($id);

        $prestationcategories = PrestationCategorie::where('parent_id', $id)->get();
        $prestations = Prestation::where('categorie_id', $id)->get();
        $data = [
            'categories' => PrestationCategorieResource::collection($prestationcategories),
            'prestations' => PrestationResource::collection($prestations),
            'title' => $categorie->label
        ];
        return [
            'status' => '200',
            'data' => json_encode($data),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none'
        ];
    }

    public function prestation($id)
    {

        $prestation = Prestation::find($id);

        $data = PrestationResource::collection([$prestation])[0];

        return [
            'status' => '200',
            'data' => json_encode($data),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none'
        ];
    }

    public function giveaway($id)
    {

        $giveaway = Giveaway::find($id);

        $data = GiveawayResource::collection([$giveaway])[0];

        return [
            'status' => '200',
            'data' => json_encode($data),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none'
        ];
    }

    public function reservation()
    {
        $prestations = json_decode($_GET['prestations'], true);

        $professeurs = professeur::professeursPrestations($prestations);

        $prestations = Prestation::where(function ($query) use ($prestations) {
            $query->whereIn('id', $prestations);
        })->get();

        $duree = $prestations->sum->duree;
        $prix = 0;

        foreach ($prestations as $key => $item) {
            $prix += ($item->has_promo && $item->prix_promo) ? $item->prix_promo : $item->prix;
        }

        $data = [
            'professeurs' => ProfesseurResource::collection($professeurs),
            'prestations' => PrestationResource::collection($prestations),
            'duree' => $duree,
            'prix' => $prix,
        ];

        return [
            'status' => '200',
            'data' => json_encode($data),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none'
        ];
    }

    public function checkout()
    {
        $prestationsJson = json_decode($_GET['prestations'], true);

        $prestations = Prestation::where(function ($query) use ($prestationsJson) {
            $query->whereIn('id', $prestationsJson);
        })->get();

        $duree = $prestations->sum->duree;
        $prix = 0;
        foreach ($prestations as $key => $item) {
            $prix += ($item->has_promo && $item->prix_promo) ? $item->prix_promo : $item->prix;
        }
        $total = $prix;

        $produits = null;
        if (isset($_GET['produits']) && $_GET['produits']) {
            $produitsJson = json_decode($_GET['produits'], true);
            $produits = Produit::where(function ($query) use ($produitsJson) {
                $query->whereIn('id', $produitsJson);
            })->get();

            $total += $produits->sum->prix;
        }

        $data = [
            'prestations' => PrestationResource::collection($prestations),
            'produits' => $produits ? ProduitResource::collection($produits) : null,
            'duree' => $duree,
            'prix' => $prix,
            'total' => $total,
        ];

        return [
            'status' => '200',
            'data' => json_encode($data),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none'
        ];
    }

    public function panier(Request $request)
    {

        $client = $this->guard()->user()->client;

        $reservation = null;
        $prix = null;
        if ($request->get('prestations')) {

            $prestationsJson = $request->get('prestations');
            $prestations = Prestation::where(function ($query) use ($prestationsJson) {
                $query->whereIn('id', $prestationsJson);
            })->get();

            $duree = $prestations->sum->duree;
            $prix = 0;

            foreach ($prestations as $key => $item) {
                $prix += ($item->has_promo && $item->prix_promo) ? $item->prix_promo : $item->prix;
            }

            if ($request->get('id'))
                $reservation = Reservation::find($request->get('id'));
            else
                $reservation = new Reservation();

            $reservation->date =  $request->get('date') . ' ' . $request->get('heure');
            $reservation->professeur_id =  ($request->get('professeur') != 'sans') ? $request->get('professeur') : null;
            $reservation->client_id =  ($client) ? $client->id : null;
            $reservation->prix =  ($prix) ? $prix : null;
            $reservation->duree =  ($duree) ? $duree : null;
            $reservation->statut_id = 2;
            $reservation->save();

            $prestationsJsonSync = [];
            foreach ($prestations as $key => $item) {
                $prestationsJsonSync[$item->id] = [
                    'professeur_id' => $reservation->professeur_id,
                    'prix' => $item->prix,
                    'duree' => $item->duree,
                    'date' => $reservation->date,
                ];
            }
            $reservation->prestations()->sync($prestationsJsonSync);
        }

        if ($request->get('produits')) {

            $produitsJson = $request->get('produits');
            $produits = Produit::where(function ($query) use ($produitsJson) {
                $query->whereIn('id', $produitsJson);
            })->get();

            $prix = $produits->sum->prix;

            $commande = new Commande();
            $commande->client_id =  ($client) ? $client->id : null;
            $commande->prix =  ($prix) ? $prix : null;
            $commande->reservation_id =  ($reservation) ? $reservation->id : null;
            $commande->statut_id = 1;
            $commande->save();

            $produitsJsonSync = [];
            foreach ($produits as $key => $item) {
                $produitsJsonSync[$item->id] = [
                    'prix' => $item->prix,
                    'quantite' => 1,
                ];
            }
            $commande->produits()->sync($produitsJsonSync);
        }


        $total = $prix;

        $produits = null;
        if (isset($_GET['produits']) && $_GET['produits']) {
            $produitsJson = json_decode($_GET['produits'], true);
            $produits = Produit::where(function ($query) use ($produitsJson) {
                $query->whereIn('id', $produitsJson);
            })->get();

            $total += $produits->sum->prix;
        }


        if ($reservation) {
            $professeurs = professeur::get();
            $details = '';
            \Carbon\Carbon::setLocale('en');
            $tempDate = \Carbon\Carbon::createFromDate($reservation->date);

            $details = 'Client : ' . $reservation->client->user->nom . ' ' . $reservation->client->user->prenom;
            $details .= '- Date : ' . $tempDate->format('d/m/Y');
            $details .= '- Heure : ' . $tempDate->format('H:i');
            foreach ($professeurs as $item) {
                if (!$item->user->role_id)
                    continue;

                $token =  $item->getFcmTOken();
                if (!$token)
                    continue;
                $item->user->sendPush('Nouveau Rendez-vous', $details, $token->token);
            }
        }

        return [

            'status' => '200',
            'data' => json_encode([
                'title' => 'Merci !',
                'message' => 'Votre commande a bien été validée.'
            ]),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none'
        ];
    }

    public function giveaway_participate(Request $request)
    {

        $client = $this->guard()->user()->client;

        $giveaway = Giveaway::find($request->get('giveaway'));

        $participation = new GiveawayParticipation();
        $participation->client_id =  ($client) ? $client->id : null;
        $participation->giveaway_id =  ($giveaway) ? $giveaway->id : null;
        $participation->save();

        $data = GiveawayResource::collection([$giveaway])[0];

        return [

            'status' => '200',
            'data' => json_encode($data),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none'
        ];
    }

    public function noter_reservation(Request $request)
    {

        $client = $this->guard()->user()->client;

        $reservation = Reservation::find($request->get('reservation'));
        $reservation->statut_id =  6;
        $reservation->save();

        $prestationsJson = [];
        foreach ($request->get('prestations') as $key => $item) {
            $prestationsJson[$item['id']] = [
                'notation' => $item['notation'],
                'notation_date' => date('Y-m-d H:i:s'),
            ];
        }
        $reservation->prestations()->sync($prestationsJson);

        $data = [
            'reservation' => ReservationResource::collection([$reservation])[0],
        ];

        return [

            'status' => '200',
            'data' => json_encode($data),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none'
        ];
    }

    public function annuler_reservation(Request $request)
    {

        $client = $this->guard()->user()->client;

        $reservation = Reservation::find($request->get('reservation'));
        $reservation->statut_id =  4;
        $reservation->save();

        $data = [
            'reservation' => ReservationResource::collection([$reservation])[0],
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
        $client = $user ? $user->client : null;

        $fcmToken = FcmToken::where(function ($query) use ($client, $request) {
            $query->where('token', $request->get('token'));
            if ($client) {
                $query->orWhere('client_id', $client->id);
            }
        })->first();

        if (!$fcmToken)
            $fcmToken = new FcmToken();
        $fcmToken->client_id =  ($client) ? $client->id : null;
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

    public function check_version(Request $request)
    {

        $data = [
            'title' => 'Mise à jour',
            'icon' => 'https://image.flaticon.com/icons/svg/426/426867.svg',
            'failed' => false,
            'link' => [
                'text' => 'Mettre à jour',
                'link' => '#'
            ],
            'description' => 'Mise à jour disponible avec de nouvelles fonctionnalités, une navigation plus rapide, des corrections de bugs et plus encore. Elle prend généralement moins d\'une minute.',
        ];

        return [
            'status' => '200',
            'data' => json_encode($data),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none'
        ];
    }

    public function profil(Request $request)
    {

        $user = $this->guard()->user();
        $client = $user->client;

        $nextReservation = Reservation::where('client_id', $client->id)->where('date', '>=', date('Y-m-d'))->orderBy('date')->first();
        $reservations = Reservation::where('client_id', $client->id)->orderBy('date')->get();
        $commandes = Commande::where('client_id', $client->id)->orderBy('created_at')->get();
        $evaluations = Reservation::whereHas('prestations', function ($query) use ($client) {
            $query->whereNotNull('notation_date');
            $query->where('client_id', $client->id);
        })->get();

        $data = [
            'next_reservation' => $nextReservation ? ReservationResource::collection([$nextReservation]) : null,
            'reservations' => ReservationResource::collection($reservations),
            'evaluations' => ReservationResource::collection($evaluations),
            'commandes' => CommandeResource::collection($commandes),
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

    private function guard()
    {
        return Auth::guard();
    }

    public function creneaux(Request $request)
    {

        \Carbon\Carbon::setLocale('en');


        $professeurs = [];
        if ($request->professeur && $request->professeur != 'sans') {
            $professeurs = professeur::where('id', $request->professeur)->get();
        } else {
            $prestations = json_decode($_GET['prestations'], true);
            $professeurs = professeur::professeursPrestations($prestations);
        }

        $today = \Carbon\Carbon::today();

        $calendarData = [];
        $tempDate = \Carbon\Carbon::createFromDate($today->year, $today->month, $today->day);

        $skip = $tempDate->dayOfWeek;

        for ($i = 0; $i < $skip; $i++) {
            $tempDate->subDay();
        }


        //loops through month
        do {

            $calendarDataWeek = [];
            //loops through each week
            for ($i = 0; $i < 7; $i++) {

                $creneauxHoraires = [];

                $disponibilites = array();
                if ($tempDate->format('Y-m-d') >= date('Y-m-d')) {

                    foreach ($professeurs as $professeur) {
                        $disponibilite = $professeur->disponibilite($tempDate->format('Y-m-d'), $request->duree);
                        $disponibilites = array_merge($disponibilites, $disponibilite);
                    }

                    $disponibilites = array_unique($disponibilites);
                    sort($disponibilites);
                }

                $matin = [];
                $aprem = [];
                foreach ($disponibilites as $dispo) {
                    if ($dispo < '13:00') {
                        $matin[] = $dispo;
                    } else {
                        $aprem[] = $dispo;
                    }
                }

                $creneauxHoraires[] = [
                    'title' => 'Matin',
                    'creneaux' =>  $matin
                ];
                $creneauxHoraires[] = [
                    'title' => 'Aprés-midi',
                    'creneaux' =>  $aprem
                ];

                $calendarDataWeek[] = [
                    'day' => $tempDate->day,
                    'month' => $tempDate->month,
                    'name' => $tempDate->shortDayName,
                    'date' => $tempDate->format('Y-m-d'),
                    'periodes' => $creneauxHoraires
                ];

                $tempDate->addDay();
            }
            $calendarData[] = [
                'month' => $tempDate->monthName . ' ' . $tempDate->year,
                'week' => $calendarDataWeek,
            ];
        } while ($tempDate->month <= 10);

        $data = [
            'calendar' => $calendarData
        ];
        return [
            'status' => '200',
            'data' => json_encode($data),
            'dataSize' => 100,
            'key' => 'test',
            'algo' => 'none'
        ];
    }
}
