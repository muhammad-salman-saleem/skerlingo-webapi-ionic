<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Actualite;
use App\B2bMeeting;
use App\Client;
use App\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Actualite as ActualiteResource;
use App\Http\Resources\EntrepriseAdmin;
use App\Http\Resources\Produit as ResourcesProduit;
use App\Http\Resources\Rfq as RfqResource;
use App\Http\Resources\RubriqueTree;
use App\Marque;
use App\Produit;
use App\Rfq;
use App\RfqEntreprise;
use App\Rubrique;
use App\Slide;
use App\User;

class StatisticController extends Controller
{

    public function dashboard(Request $request)
    {

        $client = null;
        //$client = $this->guard()->user()->client;

        $date = explode(' - ', $request->get('date'));
        $from = date($date[0] . ' 00:00:00');
        $to = date($date[1] . ' 23:59:59');

        $earlier = new \DateTime($date[0]);
        $later = new \DateTime($date[1]);
        $diffDays = $later->diff($earlier)->format("%a");

        $actualites = Actualite::where('enabled', 1)->orderBy('date', 'desc')->take(1)->get();

        $dateStart = new \Datetime($from);
        $dateEnd = new \Datetime($to);

        $top_statistics = [];

        $new_products = Produit::count();
        $top_statistics[] = [
            'label' => 'Formations',
            'link' => 'produits',
            'count' => $new_products,
        ];

        $categories = Rubrique::whereNull('parent_id')->count();
        $top_statistics[] = [
            'label' => 'Rubriques',
            'link' => 'categories',
            'count' => $categories,
        ];


        $marques = Marque::count();
        $top_statistics[] = [
            'label' => 'Références',
            'link' => 'produits',
            'count' => $marques,
        ];

        $slides = Slide::count();
        $top_statistics[] = [
            'label' => 'Slides',
            'link' => 'slides',
            'count' => $slides,
        ];


        return response()->json([
            'top_statistics' => $top_statistics,
            'all_statistics' => [],
            'progress_charts' => [],
            'charts' => [],
            'ca_chiffres' => 0,
            'rfqs' => [],
            'actualites' => ActualiteResource::collection($actualites),
            'top_products' => [],
            'top_entreprises' => [],
            'top_secteurs' => [],
        ]);
    }

    private function guard()
    {
        return Auth::guard();
    }
}
