<?php

namespace App\Http\Controllers;

use Spatie\Searchable\Search;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Spatie\Searchable\ModelSearchAspect;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Client;
use App\ClientDocument;
use App\User;
use App;
use App\Agence;
use App\B2bInscription;
use App\B2bMeeting;
use Illuminate\Support\Str;
use App\Banque;
use App\BlogPost;
use App\Contact;
use App\Entreprise;
use App\EntrepriseTraking;
use App\Professeur;
use App\Ville;
use Sichikawa\LaravelSendgridDriver\Transport\SendgridTransport;
use App\Http\Resources\RubriqueTree as RubriqueTreeResource;

use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
use App\Http\Resources\Produit as ProduitResource;
use App\Http\Resources\Rfq as RfqResource;
use App\Http\Resources\B2bMeeting as B2bMeetingResource;
use App\Http\Resources\BlogPost as ResourcesBlogPost;
use App\Http\Resources\Marque as ResourcesMarque;
use App\Http\Resources\Rfq as ResourcesRfq;
use App\Http\Resources\SlideAC;
use App\Http\Resources\SlideTree;
use App\Http\Resources\TraductionTree as TraductionTreeResource;
use App\Tarif;

use App\Imports\QuartiersImport;
use App\Lecon;
use App\Lettre;
use App\Marque;
use App\Pays;
use App\Produit;
use App\Rfq;
use App\RfqEntreprise;
use App\Rubrique;
use App\Slide;
use App\Traduction;
use Maatwebsite\Excel\Facades\Excel;

class SiteController extends Controller
{

    public function index()
    {

        exit;

        $letters = array(
            0 =>
            array(
                0 => '17',
                1 => 'a',
                2 => 'ア',
                3 => 'armor',
                4 => 'armure',
                5 => '1',
                6 => '2',
                7 => '1',
                8 => 'a.mp3',
                9 => 'illustration_katakana_a.svg',
                10 => 'letter_drawing_katakana_a.svg',
                11 => 'stroke_order_katakana_a.svg',
                12 => '#CC6666',
            ),
            1 =>
            array(
                0 => '17',
                1 => 'i',
                2 => 'イ',
                3 => 'inteligent pigeon',
                4 => 'pigeon intelligent',
                5 => '1',
                6 => '2',
                7 => '2',
                8 => 'i.mp3',
                9 => 'illustration_katakana_i.svg',
                10 => 'letter_drawing_katakana_i.svg',
                11 => 'stroke_order_katakana_i.svg',
                12 => '#CC9933',
            ),
            2 =>
            array(
                0 => '17',
                1 => 'u',
                2 => 'ウ',
                3 => 'unbearable pain',
                4 => 'ours en peine',
                5 => '3',
                6 => '2',
                7 => '3',
                8 => 'u.mp3',
                9 => 'illustration_katakana_u.svg',
                10 => 'letter_drawing_katakana_u.svg',
                11 => 'stroke_order_katakana_u.svg',
                12 => '#CC99CC',
            ),
            3 =>
            array(
                0 => '17',
                1 => 'e',
                2 => 'エ',
                3 => 'fit emily',
                4 => 'grand écart',
                5 => '1',
                6 => '3',
                7 => '4',
                8 => 'e.mp3',
                9 => 'illustration_katakana_e.svg',
                10 => 'letter_drawing_katakana_e.svg',
                11 => 'stroke_order_katakana_e.svg',
                12 => '#CC99CC',
            ),
            4 =>
            array(
                0 => '17',
                1 => 'o',
                2 => 'オ',
                3 => 'octopus',
                4 => 'octopus',
                5 => '3',
                6 => '3',
                7 => '5',
                8 => 'o.mp3',
                9 => 'illustration_katakana_o.svg',
                10 => 'letter_drawing_katakana_o.svg',
                11 => 'stroke_order_katakana_o.svg',
                12 => '#6699CC',
            ),
            5 =>
            array(
                0 => '18',
                1 => 'ka',
                2 => 'カ',
                3 => 'karateka (2)',
                4 => 'karateka (2)',
                5 => '2',
                6 => '2',
                7 => '6',
                8 => 'ka.mp3',
                9 => 'illustration_katakana_ka.svg',
                10 => 'letter_drawing_katakana_ka.svg',
                11 => 'stroke_order_katakana_ka.svg',
                12 => '#CC6666',
            ),
            6 =>
            array(
                0 => '18',
                1 => 'ki',
                2 => 'キ',
                3 => 'kirin the skier (2)',
                4 => 'skieuse kirin (2)',
                5 => '2',
                6 => '3',
                7 => '7',
                8 => 'ki.mp3',
                9 => 'illustration_katakana_ki.svg',
                10 => 'letter_drawing_katakana_ki.svg',
                11 => 'stroke_order_katakana_ki.svg',
                12 => '#CC99CC',
            ),
            7 =>
            array(
                0 => '18',
                1 => 'ku',
                2 => 'ク',
                3 => 'cookie',
                4 => 'cookie croqué',
                5 => '3',
                6 => '2',
                7 => '8',
                8 => 'ku.mp3',
                9 => 'illustration_katakana_ku.svg',
                10 => 'letter_drawing_katakana_ku.svg',
                11 => 'stroke_order_katakana_ku.svg',
                12 => '#CC9933',
            ),
            8 =>
            array(
                0 => '18',
                1 => 'ke',
                2 => 'ケ',
                3 => 'keko training',
                4 => 'entrainement keko',
                5 => '3',
                6 => '3',
                7 => '9',
                8 => 'ke.mp3',
                9 => 'illustration_katakana_ke.svg',
                10 => 'letter_drawing_katakana_ke.svg',
                11 => 'stroke_order_katakana_ke.svg',
                12 => '#99CC33',
            ),
            9 =>
            array(
                0 => '18',
                1 => 'ko',
                2 => 'コ',
                3 => 'cola',
                4 => 'cola',
                5 => '2',
                6 => '2',
                7 => '10',
                8 => 'ko.mp3',
                9 => 'illustration_katakana_ko.svg',
                10 => 'letter_drawing_katakana_ko.svg',
                11 => 'stroke_order_katakana_ko.svg',
                12 => '#99CC33',
            ),
            10 =>
            array(
                0 => '19',
                1 => 'sa',
                2 => 'サ',
                3 => 'sardines',
                4 => 'sardines',
                5 => '2',
                6 => '3',
                7 => '11',
                8 => 'sa.mp3',
                9 => 'illustration_katakana_sa.svg',
                10 => 'letter_drawing_katakana_sa.svg',
                11 => 'stroke_order_katakana_sa.svg',
                12 => '#CC6666',
            ),
            11 =>
            array(
                0 => '19',
                1 => 'shi',
                2 => 'シ',
                3 => 'chihuahua',
                4 => 'chihuahua',
                5 => '3',
                6 => '3',
                7 => '12',
                8 => 'shi.mp3',
                9 => 'illustration_katakana_shi.svg',
                10 => 'letter_drawing_katakana_shi.svg',
                11 => 'stroke_order_katakana_shi.svg',
                12 => '#CC9933',
            ),
            12 =>
            array(
                0 => '19',
                1 => 'su',
                2 => 'ス',
                3 => 'void',
                4 => 'soucoupe volante',
                5 => '3',
                6 => '2',
                7 => '13',
                8 => 'su.mp3',
                9 => 'illustration_katakana_su.svg',
                10 => 'letter_drawing_katakana_su.svg',
                11 => 'stroke_order_katakana_su.svg',
                12 => '#003366',
            ),
            13 =>
            array(
                0 => '19',
                1 => 'se',
                2 => 'セ',
                3 => 'serpent',
                4 => 'serpent',
                5 => '2',
                6 => '2',
                7 => '14',
                8 => 'se.mp3',
                9 => 'illustration_katakana_se.svg',
                10 => 'letter_drawing_katakana_se.svg',
                11 => 'stroke_order_katakana_se.svg',
                12 => '#99CC33',
            ),
            14 =>
            array(
                0 => '19',
                1 => 'so',
                2 => 'ソ',
                3 => 'sorcerer jump',
                4 => 'saut de sorcière',
                5 => '2',
                6 => '2',
                7 => '15',
                8 => 'so.mp3',
                9 => 'illustration_katakana_so.svg',
                10 => 'letter_drawing_katakana_so.svg',
                11 => 'stroke_order_katakana_so.svg',
                12 => '#6699CC',
            ),
            15 =>
            array(
                0 => '20',
                1 => 'ta',
                2 => 'タ',
                3 => 'strawberry tarte',
                4 => 'tarte aux fraises',
                5 => '3',
                6 => '3',
                7 => '16',
                8 => 'ta.mp3',
                9 => 'illustration_katakana_ta.svg',
                10 => 'letter_drawing_katakana_ta.svg',
                11 => 'stroke_order_katakana_ta.svg',
                12 => '#CC6666',
            ),
            16 =>
            array(
                0 => '20',
                1 => 'chi',
                2 => 'チ',
                3 => 'chimpanzee (2)',
                4 => 'chimpanzée (2)',
                5 => '3',
                6 => '3',
                7 => '17',
                8 => 'chi.mp3',
                9 => 'illustration_katakana_chi.svg',
                10 => 'letter_drawing_katakana_chi.svg',
                11 => 'stroke_order_katakana_chi.svg',
                12 => '#99CC33',
            ),
            17 =>
            array(
                0 => '20',
                1 => 'tsu',
                2 => 'ツ',
                3 => 'tsubasa',
                4 => 'tsubasa',
                5 => '3',
                6 => '3',
                7 => '18',
                8 => 'tsu.mp3',
                9 => 'illustration_katakana_tsu.svg',
                10 => 'letter_drawing_katakana_tsu.svg',
                11 => 'stroke_order_katakana_tsu.svg',
                12 => '#CC99CC',
            ),
            18 =>
            array(
                0 => '20',
                1 => 'te',
                2 => 'テ',
                3 => 'telescope',
                4 => 'téléscope',
                5 => '2',
                6 => '3',
                7 => '19',
                8 => 'te.mp3',
                9 => 'illustration_katakana_te.svg',
                10 => 'letter_drawing_katakana_te.svg',
                11 => 'stroke_order_katakana_te.svg',
                12 => '#99CC33',
            ),
            19 =>
            array(
                0 => '20',
                1 => 'to',
                2 => 'ト',
                3 => 'toaster',
                4 => 'toaster',
                5 => '1',
                6 => '2',
                7 => '20',
                8 => 'to.mp3',
                9 => 'illustration_katakana_to.svg',
                10 => 'letter_drawing_katakana_to.svg',
                11 => 'stroke_order_katakana_to.svg',
                12 => '#6699CC',
            ),
            20 =>
            array(
                0 => '21',
                1 => 'na',
                2 => 'ナ',
                3 => 'navy vessel',
                4 => 'navire marin',
                5 => '1',
                6 => '2',
                7 => '21',
                8 => 'na.mp3',
                9 => 'illustration_katakana_na.svg',
                10 => 'letter_drawing_katakana_na.svg',
                11 => 'stroke_order_katakana_na.svg',
                12 => '#CC3333',
            ),
            21 =>
            array(
                0 => '21',
                1 => 'ni',
                2 => '二',
                3 => 'two needles (2)',
                4 => 'deux nids (2)',
                5 => '1',
                6 => '2',
                7 => '22',
                8 => 'ni.mp3',
                9 => 'illustration_katakana_ni.svg',
                10 => 'letter_drawing_katakana_ni.svg',
                11 => 'stroke_order_katakana_ni.svg',
                12 => '#333366',
            ),
            22 =>
            array(
                0 => '21',
                1 => 'nu',
                2 => 'ヌ',
                3 => 'nougat eater shark',
                4 => 'requi mangeur de nougat',
                5 => '3',
                6 => '2',
                7 => '23',
                8 => 'nu.mp3',
                9 => 'illustration_katakana_nu.svg',
                10 => 'letter_drawing_katakana_nu.svg',
                11 => 'stroke_order_katakana_nu.svg',
                12 => '#6699CC',
            ),
            23 =>
            array(
                0 => '21',
                1 => 'ne',
                2 => 'ネ',
                3 => 'neko (2)',
                4 => 'neko (2)',
                5 => '3',
                6 => '4',
                7 => '24',
                8 => 'ne.mp3',
                9 => 'illustration_katakana_ne.svg',
                10 => 'letter_drawing_katakana_ne.svg',
                11 => 'stroke_order_katakana_ne.svg',
                12 => '#99CC33',
            ),
            24 =>
            array(
                0 => '21',
                1 => 'no',
                2 => 'ノ',
                3 => 'north at 12 am',
                4 => 'nord à 13h',
                5 => '1',
                6 => '1',
                7 => '25',
                8 => 'no.mp3',
                9 => 'illustration_katakana_no.svg',
                10 => 'letter_drawing_katakana_no.svg',
                11 => 'stroke_order_katakana_no.svg',
                12 => '#6699CC',
            ),
            25 =>
            array(
                0 => '22',
                1 => 'ha',
                2 => 'ハ',
                3 => 'hatchet',
                4 => 'hache',
                5 => '1',
                6 => '2',
                7 => '26',
                8 => 'ha.mp3',
                9 => 'illustration_katakana_ha.svg',
                10 => 'letter_drawing_katakana_ha.svg',
                11 => 'stroke_order_katakana_ha.svg',
                12 => '#99CC33',
            ),
            26 =>
            array(
                0 => '22',
                1 => 'hi',
                2 => 'ヒ',
                3 => 'baby hippo',
                4 => 'bébé hippo',
                5 => '1',
                6 => '2',
                7 => '27',
                8 => 'hi.mp3',
                9 => 'illustration_katakana_hi.svg',
                10 => 'letter_drawing_katakana_hi.svg',
                11 => 'stroke_order_katakana_hi.svg',
                12 => '#CC9933',
            ),
            27 =>
            array(
                0 => '22',
                1 => 'fu',
                2 => 'フ',
                3 => 'full of ant',
                4 => 'bain de fourmie',
                5 => '1',
                6 => '1',
                7 => '28',
                8 => 'fu.mp3',
                9 => 'illustration_katakana_fu.svg',
                10 => 'letter_drawing_katakana_fu.svg',
                11 => 'stroke_order_katakana_fu.svg',
                12 => '#CC99CC',
            ),
            28 =>
            array(
                0 => '22',
                1 => 'he',
                2 => 'ヘ',
                3 => 'helicopter',
                4 => 'hélicoptère',
                5 => '1',
                6 => '1',
                7 => '29',
                8 => 'he.mp3',
                9 => 'illustration_katakana_he.svg',
                10 => 'letter_drawing_katakana_he.svg',
                11 => 'stroke_order_katakana_he.svg',
                12 => '#CC99CC',
            ),
            29 =>
            array(
                0 => '22',
                1 => 'ho',
                2 => 'ホ',
                3 => 'hockey player',
                4 => 'joueur de hockey',
                5 => '3',
                6 => '4',
                7 => '30',
                8 => 'ho.mp3',
                9 => 'illustration_katakana_ho.svg',
                10 => 'letter_drawing_katakana_ho.svg',
                11 => 'stroke_order_katakana_ho.svg',
                12 => '#99CC33',
            ),
            30 =>
            array(
                0 => '23',
                1 => 'ma',
                2 => 'マ',
                3 => 'macaque',
                4 => 'macaque',
                5 => '3',
                6 => '2',
                7 => '31',
                8 => 'ma.mp3',
                9 => 'illustration_katakana_ma.svg',
                10 => 'letter_drawing_katakana_ma.svg',
                11 => 'stroke_order_katakana_ma.svg',
                12 => '#6699CC',
            ),
            31 =>
            array(
                0 => '23',
                1 => 'mi',
                2 => 'ミ',
                3 => 'missiles',
                4 => 'missiles',
                5 => '1',
                6 => '3',
                7 => '32',
                8 => 'mi.mp3',
                9 => 'illustration_katakana_mi.svg',
                10 => 'letter_drawing_katakana_mi.svg',
                11 => 'stroke_order_katakana_mi.svg',
                12 => '#CC9933',
            ),
            32 =>
            array(
                0 => '23',
                1 => 'mu',
                2 => 'ム',
                3 => 'muscleman',
                4 => 'muscleman',
                5 => '3',
                6 => '2',
                7 => '33',
                8 => 'mu.mp3',
                9 => 'illustration_katakana_mu.svg',
                10 => 'letter_drawing_katakana_mu.svg',
                11 => 'stroke_order_katakana_mu.svg',
                12 => '#CC99CC',
            ),
            33 =>
            array(
                0 => '23',
                1 => 'me',
                2 => 'メ',
                3 => 'melty dragon',
                4 => 'dragon melty',
                5 => '1',
                6 => '2',
                7 => '34',
                8 => 'me.mp3',
                9 => 'illustration_katakana_me.svg',
                10 => 'letter_drawing_katakana_me.svg',
                11 => 'stroke_order_katakana_me.svg',
                12 => '#99CC33',
            ),
            34 =>
            array(
                0 => '23',
                1 => 'mo',
                2 => 'モ',
                3 => 'monk',
                4 => 'monk',
                5 => '2',
                6 => '3',
                7 => '35',
                8 => 'mo.mp3',
                9 => 'illustration_katakana_mo.svg',
                10 => 'letter_drawing_katakana_mo.svg',
                11 => 'stroke_order_katakana_mo.svg',
                12 => '#6699CC',
            ),
            35 =>
            array(
                0 => '24',
                1 => 'ya',
                2 => 'ヤ',
                3 => 'yacht (2)',
                4 => 'yacht (2)',
                5 => '1',
                6 => '2',
                7 => '36',
                8 => 'ya.mp3',
                9 => 'illustration_katakana_ya.svg',
                10 => 'letter_drawing_katakana_ya.svg',
                11 => 'stroke_order_katakana_ya.svg',
                12 => '#CC6666',
            ),
            36 =>
            array(
                0 => '24',
                1 => 'yu',
                2 => 'ユ',
                3 => 'UFO',
                4 => 'lance cailloux',
                5 => '1',
                6 => '2',
                7 => '37',
                8 => 'yu.mp3',
                9 => 'illustration_katakana_yu.svg',
                10 => 'letter_drawing_katakana_yu.svg',
                11 => 'stroke_order_katakana_yu.svg',
                12 => '#CC99CC',
            ),
            37 =>
            array(
                0 => '24',
                1 => 'yo',
                2 => 'ヨ',
                3 => 'yoga',
                4 => 'yoga',
                5 => '3',
                6 => '3',
                7 => '38',
                8 => 'yo.mp3',
                9 => 'illustration_katakana_yo.svg',
                10 => 'letter_drawing_katakana_yo.svg',
                11 => 'stroke_order_katakana_yo.svg',
                12 => '#6699CC',
            ),
            38 =>
            array(
                0 => '25',
                1 => 'ra',
                2 => 'ラ',
                3 => 'ramen',
                4 => 'ramène ton ramen',
                5 => '1',
                6 => '2',
                7 => '39',
                8 => 'ra.mp3',
                9 => 'illustration_katakana_ra.svg',
                10 => 'letter_drawing_katakana_ra.svg',
                11 => 'stroke_order_katakana_ra.svg',
                12 => '#CC6666',
            ),
            39 =>
            array(
                0 => '25',
                1 => 'ri',
                2 => 'リ',
                3 => 'river',
                4 => 'rivière',
                5 => '1',
                6 => '2',
                7 => '40',
                8 => 'ri.mp3',
                9 => 'illustration_katakana_ri.svg',
                10 => 'letter_drawing_katakana_ri.svg',
                11 => 'stroke_order_katakana_ri.svg',
                12 => '#CC99CC',
            ),
            40 =>
            array(
                0 => '25',
                1 => 'ru',
                2 => 'ル',
                3 => 'rugby kick',
                4 => 'tir de rugby',
                5 => '2',
                6 => '2',
                7 => '41',
                8 => 'ru.mp3',
                9 => 'illustration_katakana_ru.svg',
                10 => 'letter_drawing_katakana_ru.svg',
                11 => 'stroke_order_katakana_ru.svg',
                12 => '#99CC33',
            ),
            41 =>
            array(
                0 => '25',
                1 => 're',
                2 => 'レ',
                3 => 'ray',
                4 => 'raie',
                5 => '1',
                6 => '1',
                7 => '42',
                8 => 're.mp3',
                9 => 'illustration_katakana_re.svg',
                10 => 'letter_drawing_katakana_re.svg',
                11 => 'stroke_order_katakana_re.svg',
                12 => '#6699CC',
            ),
            42 =>
            array(
                0 => '25',
                1 => 'ro',
                2 => 'ロ',
                3 => 'squarre robot',
                4 => 'robot carré',
                5 => '2',
                6 => '3',
                7 => '43',
                8 => 'ro.mp3',
                9 => 'illustration_katakana_ro.svg',
                10 => 'letter_drawing_katakana_ro.svg',
                11 => 'stroke_order_katakana_ro.svg',
                12 => '#CC6666',
            ),
            43 =>
            array(
                0 => '26',
                1 => 'wa',
                2 => 'ワ',
                3 => 'walkie-talkie',
                4 => 'talkie-walkie',
                5 => '2',
                6 => '2',
                7 => '44',
                8 => 'wa.mp3',
                9 => 'illustration_katakana_wa.svg',
                10 => 'letter_drawing_katakana_wa.svg',
                11 => 'stroke_order_katakana_wa.svg',
                12 => '#99CC33',
            ),
            44 =>
            array(
                0 => '26',
                1 => 'w(o)',
                2 => 'ヲ',
                3 => 'wolfy',
                4 => 'wolfy',
                5 => '3',
                6 => '3',
                7 => '45',
                8 => 'w(o).mp3',
                9 => 'illustration_katakana_w(o).svg',
                10 => 'letter_drawing_katakana_w(o).svg',
                11 => 'stroke_order_katakana_w(o).svg',
                12 => '#CC6666',
            ),
            45 =>
            array(
                0 => '26',
                1 => 'n',
                2 => 'ン',
                3 => 'switch on button',
                4 => 'bouton mise sous tension',
                5 => '3',
                6 => '2',
                7 => '46',
                8 => 'n.mp3',
                9 => 'illustration_katakana_n.svg',
                10 => 'letter_drawing_katakana_n.svg',
                11 => 'stroke_order_katakana_n.svg',
                12 => '#6699CC',
            ),
        );

        foreach ($letters as $item) {

            $lecon = new Lettre();
            $lecon->type = 'katakana';
            $lecon->lecon_id = $item[0];
            $lecon->romaji = $item[1];
            $lecon->kana = $item[2];
            $lecon->stars = $item[5];
            $lecon->stroke = $item[6];
            $lecon->number = $item[7];
            $lecon->prononciation = $item[8];
            $lecon->illustration = $item[9];
            $lecon->illustration_letter = $item[10];
            $lecon->color = $item[12];

            $lecon->setTranslation('label', 'fr', $item[4]);
            //$lecon->setTranslation('description', 'fr', $item[12] ? str_replace('"', "'", $item[12]) : null);

            $lecon->setTranslation('label', 'en', $item[3]);
            //$lecon->setTranslation('description', 'en', $item[5]);
            $lecon->save();
        }
        exit('Ok letters');

        $lecons = array(
            1 =>
            array(
                0 => 'hiragana',
                1 => '',
                2 => 'Introduction',
                3 => 'Apprentissage du hiragana',
                4 => 'Introduction',
                5 => 'Learning hiragana',
            ),
            2 =>
            array(
                0 => 'hiragana',
                1 => 'A',
                2 => 'Leçon 1',
                3 => 'a - i - u - e - o',
                4 => 'Lesson 1',
                5 => 'a - i - u - e - o',
            ),
            3 =>
            array(
                0 => 'hiragana',
                1 => 'K',
                2 => 'Leçon 2',
                3 => 'ka - ki - ku - ke - ko',
                4 => 'Lesson 2',
                5 => 'ka - ki - ku - ke - ko',
            ),
            4 =>
            array(
                0 => 'hiragana',
                1 => 'S',
                2 => 'Leçon 3',
                3 => 'sa - shi - su - se - so',
                4 => 'Lesson 3',
                5 => 'sa - shi - su - se - so',
            ),
            5 =>
            array(
                0 => 'hiragana',
                1 => 'T',
                2 => 'Leçon 4',
                3 => 'ta - chi - tsu - te - to',
                4 => 'Lesson 4',
                5 => 'ta - chi - tsu - te - to',
            ),
            6 =>
            array(
                0 => 'hiragana',
                1 => 'N',
                2 => 'Leçon 5',
                3 => 'na - ni - nu - ne - no',
                4 => 'Lesson 5',
                5 => 'na - ni - nu - ne - no',
            ),
            7 =>
            array(
                0 => 'hiragana',
                1 => 'H',
                2 => 'Leçon 6',
                3 => 'ha - hi - fu - he - ho',
                4 => 'Lesson 6',
                5 => 'ha - hi - fu - he - ho',
            ),
            8 =>
            array(
                0 => 'hiragana',
                1 => 'M',
                2 => 'Leçon 7',
                3 => 'ma - mi - mu - me - mo',
                4 => 'Lesson 7',
                5 => 'ma - mi - mu - me - mo',
            ),
            9 =>
            array(
                0 => 'hiragana',
                1 => 'Y',
                2 => 'Leçon 8',
                3 => 'ya - yu - yo',
                4 => 'Lesson 8',
                5 => 'ya - yu - yo',
            ),
            10 =>
            array(
                0 => 'hiragana',
                1 => 'R',
                2 => 'Leçon 9',
                3 => 'ra - ri - ru - re - ro',
                4 => 'Lesson 9',
                5 => 'ra - ri - ru - re - ro',
            ),
            11 =>
            array(
                0 => 'hiragana',
                1 => 'W',
                2 => 'Leçon 10',
                3 => 'wa - wo - n',
                4 => 'Lesson 10',
                5 => 'wa - wo - n',
            ),
            12 =>
            array(
                0 => 'hiragana',
                1 => '',
                2 => 'Leçon 11',
                3 => 'Les hiragana modifiés',
                4 => 'Lesson 11',
                5 => 'Modified hiragana',
            ),
            13 =>
            array(
                0 => 'hiragana',
                1 => '',
                2 => 'Leçon 12',
                3 => 'Les mini ya, yu, yo',
                4 => 'Lesson 12',
                5 => 'Mini ya, yu, yo',
            ),
            14 =>
            array(
                0 => 'hiragana',
                1 => '',
                2 => 'Leçon 13',
                3 => 'Liste des hiraganas similaires',
                4 => 'Lesson 13',
                5 => 'List of similar hiraganas',
            ),
            15 =>
            array(
                0 => 'hiragana',
                1 => '',
                2 => 'Leçon 14',
                3 => 'Liste des règles de prononciation',
                4 => 'Lesson 14',
                5 => 'List of pronunciation rules',
            ),
            16 =>
            array(
                0 => 'katakana',
                1 => '',
                2 => 'Introduction',
                3 => 'Apprentissage du katakana',
                4 => 'Introduction',
                5 => 'Learning katakana',
            ),
            17 =>
            array(
                0 => 'katakana',
                1 => 'A',
                2 => 'Leçon 1',
                3 => 'a - i - u - e - o',
                4 => 'Leçon 1',
                5 => 'a - i - u - e - o',
            ),
            18 =>
            array(
                0 => 'katakana',
                1 => 'K',
                2 => 'Leçon 2',
                3 => 'ka - ki - ku - ke - ko',
                4 => 'Leçon 2',
                5 => 'ka - ki - ku - ke - ko',
            ),
            19 =>
            array(
                0 => 'katakana',
                1 => 'S',
                2 => 'Leçon 3',
                3 => 'sa - shi - su - se - so',
                4 => 'Leçon 3',
                5 => 'sa - shi - su - se - so',
            ),
            20 =>
            array(
                0 => 'katakana',
                1 => 'T',
                2 => 'Leçon 4',
                3 => 'ta - chi - tsu - te - to',
                4 => 'Leçon 4',
                5 => 'ta - chi - tsu - te - to',
            ),
            21 =>
            array(
                0 => 'katakana',
                1 => 'N',
                2 => 'Leçon 5',
                3 => 'na - ni - nu - ne - no',
                4 => 'Leçon 5',
                5 => 'na - ni - nu - ne - no',
            ),
            22 =>
            array(
                0 => 'katakana',
                1 => 'H',
                2 => 'Leçon 6',
                3 => 'ha - hi - fu - he - ho',
                4 => 'Leçon 6',
                5 => 'ha - hi - fu - he - ho',
            ),
            23 =>
            array(
                0 => 'katakana',
                1 => 'M',
                2 => 'Leçon 7',
                3 => 'ma - mi - mu - me - mo',
                4 => 'Leçon 7',
                5 => 'ma - mi - mu - me - mo',
            ),
            24 =>
            array(
                0 => 'katakana',
                1 => 'Y',
                2 => 'Leçon 8',
                3 => 'ya - yu - yo',
                4 => 'Leçon 8',
                5 => 'ya - yu - yo',
            ),
            25 =>
            array(
                0 => 'katakana',
                1 => 'R',
                2 => 'Leçon 9',
                3 => 'ra - ri - ru - re - ro',
                4 => 'Leçon 9',
                5 => 'ra - ri - ru - re - ro',
            ),
            26 =>
            array(
                0 => 'katakana',
                1 => 'W',
                2 => 'Leçon 10',
                3 => 'wa - wo - n',
                4 => 'Leçon 10',
                5 => 'wa - wo - n',
            ),
            27 =>
            array(
                0 => 'katakana',
                1 => '',
                2 => 'Leçon 11',
                3 => 'Les katakanas modifiés',
                4 => 'Leçon 11',
                5 => 'Modified katakana',
            ),
            28 =>
            array(
                0 => 'katakana',
                1 => '',
                2 => 'Leçon 12',
                3 => 'Les mini ya, yu, yo',
                4 => 'Leçon 12',
                5 => 'Mini ya, yu, yo',
            ),
            29 =>
            array(
                0 => 'katakana',
                1 => '',
                2 => 'Leçon 13',
                3 => 'Les katakanas similaires',
                4 => 'Leçon 13',
                5 => 'Tackling similar katakana',
            ),
            30 =>
            array(
                0 => 'katakana',
                1 => '',
                2 => 'Leçon 14',
                3 => 'Règles pour les mots étranger',
                4 => 'Leçon 14',
                5 => 'Rules for foreign names',
            ),
        );
        foreach ($lecons as $item) {

            $lecon = new Lecon();
            $lecon->type = $item[0];
            $lecon->letter = $item[1];

            $lecon->setTranslation('label', 'fr', $item[2]);
            $lecon->setTranslation('introduction', 'fr', $item[3]);

            $lecon->setTranslation('label', 'en', $item[4]);
            $lecon->setTranslation('introduction', 'en', $item[5]);
            $lecon->save();
        }
        exit('ok');

        return redirect()->to('boost-sales');

        $pageTitle = 'Produits';

        $rubriques = RubriqueTreeResource::collection(Rubrique::where('secteur', 1)->whereNull('parent_id')->orderBy('ordre')->get())->toArray([]);
        $marques = ResourcesMarque::collection(Marque::where('enabled', 1)->get())->toArray([]);
        $slides = SlideAC::collection(Slide::orderBy('ordre')->get())->toArray([]);
        $produits = ProduitResource::collection(Produit::inRandomOrder()->limit(8)->get())->toArray([]);

        $pageTitle = 'skerlingo';

        $traductions = Traduction::where(function ($query) {
            $query->whereIn('rubrique_id', [2, 3, 4, 5, 6, 7]);
        })->orderBy('ordre')->get()->keyBy->id;
        $traductions = TraductionTreeResource::collection($traductions)->toArray([]);

        return view('site.skerlingo.index', ['traductions' => $traductions, 'slides' => $slides, 'marques' => $marques, 'rubriques' => $rubriques,  'produits' => $produits, 'pageTitle' => $pageTitle]);
    }

    public function about()
    {
        $pageTitle = 'skerlingo | A propos';

        $traductions = Traduction::where(function ($query) {
            $query->whereIn('rubrique_id', [9]);
        })->orderBy('ordre')->get()->keyBy->id;
        $traductions = TraductionTreeResource::collection($traductions)->toArray([]);

        return view('site.skerlingo.about', ['pageTitle' => $pageTitle, 'traductions' => $traductions]);
    }

    public function cgu()
    {
        $pageTitle = 'CGU | A propos';

        $traductions = Traduction::where(function ($query) {
            $query->whereIn('rubrique_id', [11]);
        })->orderBy('ordre')->get()->keyBy->id;
        $traductions = TraductionTreeResource::collection($traductions)->toArray([]);

        return view('site.skerlingo.cgu', ['pageTitle' => $pageTitle, 'traductions' => $traductions]);
    }

    public function products(Request $request)
    {

        Session::forget(['rfq_normal', 'inscription_b2b', 'new_b2b_meeting']);

        $produits = Produit::where(function ($query) use ($request) {
            $query->whereNotNull('validation_entreprise_date');
        })->get();

        $pageTitle = 'Produits';

        $rubriques = RubriqueTreeResource::collection(Rubrique::where('secteur', 1)->whereNull('parent_id')->orderBy('ordre')->get())->toArray([]);
        $produits = ProduitResource::collection($produits)->toArray([]);


        $traductions = Traduction::where(function ($query) {
            $query->whereIn('rubrique_id', [16, 19]);
        })->orderBy('ordre')->get()->keyBy->id;
        $traductions = TraductionTreeResource::collection($traductions)->toArray([]);

        return view('site.skerlingo.produits', ['traductions' => $traductions, 'produits' => $produits, 'rubriques' => $rubriques, 'pageTitle' => $pageTitle]);
    }

    public function search_products(Request $request)
    {

        $traductions = Traduction::where(function ($query) {
            $query->whereIn('rubrique_id', [16, 19]);
        })->orderBy('ordre')->get()->keyBy->id;
        $traductions = TraductionTreeResource::collection($traductions)->toArray([]);

        $keywords = preg_replace('/(\b.{1,2}\s)/', '', $request->get('keywords'));

        Session::forget(['rfq_normal', 'inscription_b2b', 'new_b2b_meeting']);

        $search = new Search();
        $search->registerModel(Produit::class, function (ModelSearchAspect $modelSearchAspect) {
            $modelSearchAspect
                ->addSearchableAttribute('label')
                ->addSearchableAttribute('introduction')
                ->addSearchableAttribute('details')
                ->addSearchableAttribute('keywords')
                ->orderByDesc('created_at');
        });
        $searchResults = $search->search($keywords);

        $pageTitle = 'Produits';

        $rubriques = RubriqueTreeResource::collection(Rubrique::where('secteur', 1)->whereNull('parent_id')->orderBy('ordre')->get())->toArray([]);
        $produits = ProduitResource::collection($searchResults->pluck('searchable'))->toArray([]);

        return view('site.skerlingo.produits', ['traductions' => $traductions, 'produits' => $produits, 'rubriques' => $rubriques, 'pageTitle' => $pageTitle, 'keywords' => $keywords]);
    }

    public function products_category($id, $slug = '')
    {

        $rubrique = Rubrique::findOrFail($id);


        if ($id != 30 && $id != 31)
            return redirect()->to('boost-sales');

        if ($rubrique->alias && $slug !== $rubrique->alias) {
            return redirect()->to($rubrique->url);
        }

        $produits = Produit::whereHas('secteur', function ($query) use ($rubrique) {
            $query->where('secteur_id', $rubrique->id)->orWhere('parent_id', $rubrique->id);
        })->whereNotNull('validation_entreprise_date')->get();

        $pageTitle = 'Produits';

        $rubriques = RubriqueTreeResource::collection(Rubrique::where('secteur', 1)->whereNull('parent_id')->orderBy('ordre')->get())->toArray([]);
        $produits = ProduitResource::collection($produits)->toArray([]);

        $traductions = Traduction::where(function ($query) {
            $query->whereIn('rubrique_id', [16, 19]);
        })->orderBy('ordre')->get()->keyBy->id;
        $traductions = TraductionTreeResource::collection($traductions)->toArray([]);

        return view($rubrique->id == 30 ? 'site.skerlingo.boost' : 'site.skerlingo.produits', ['traductions' => $traductions, 'produits' => $produits, 'rubriques' => $rubriques, 'rubrique' => $rubrique, 'pageTitle' => $pageTitle]);
    }

    public function boost_sales()
    {

        $rubrique = Rubrique::findOrFail(30);

        $produits = Produit::whereHas('secteur', function ($query) use ($rubrique) {
            $query->where('secteur_id', $rubrique->id)->orWhere('parent_id', $rubrique->id);
        })->whereNotNull('validation_entreprise_date')->get();

        $pageTitle = 'Produits';

        $rubriques = RubriqueTreeResource::collection(Rubrique::where('secteur', 1)->whereNull('parent_id')->orderBy('ordre')->get())->toArray([]);
        $produits = ProduitResource::collection($produits)->toArray([]);

        $traductions = Traduction::where(function ($query) {
            $query->whereIn('rubrique_id', [16, 19]);
        })->orderBy('ordre')->get()->keyBy->id;
        $traductions = TraductionTreeResource::collection($traductions)->toArray([]);

        return view($rubrique->id == 30 ? 'site.skerlingo.boost' : 'site.skerlingo.produits', ['traductions' => $traductions, 'produits' => $produits, 'rubriques' => $rubriques, 'rubrique' => $rubrique, 'pageTitle' => $pageTitle]);
    }

    public function blog(Request $request)
    {

        $articles = BlogPost::where(function ($query) use ($request) {
        })->get();


        $pageTitle = 'Blog';
        $articles = ResourcesBlogPost::collection($articles)->toArray([]);


        $traductions = Traduction::where(function ($query) {
            $query->whereIn('rubrique_id', [16, 19]);
        })->orderBy('ordre')->get()->keyBy->id;
        $traductions = TraductionTreeResource::collection($traductions)->toArray([]);

        $locateLang = Session::get('locale');

        $pageTitle = 'Export Morocco | Products and services to import from Morocco';
        $pageDescription = "Products and services to import from Morocco. Connect and request for quotations from Moroccan exporters and suppliers";
        //$pageDescription = "Import; Export; Morocco; Africa; Quotation; Quote; Exporters; Suppliers; Moroccan; Products; Services; Cars; Fish; fruits; Argan; Olive";
        if ($locateLang == 'fr') {
            $pageTitle = 'Export Morocco | Produits et services à importer du Maroc';
            $pageDescription = "Produits et services à importer du Maroc. Connectez vous avec les exportateurs du Maroc et obtenez des devis gratuits.";
        }

        return view('site.skerlingo.blog', ['traductions' => $traductions, 'articles' => $articles, 'pageTitle' => $pageTitle, 'pageDescription' => $pageDescription]);
    }

    public function blogpost_page($id, $slug = '')
    {
        $article = BlogPost::findOrFail($id);
        if ($slug !== $article->alias) {
            return redirect()->to($article->url);
        }

        $traductions = Traduction::where(function ($query) {
            $query->whereIn('rubrique_id', [17]);
        })->orderBy('ordre')->get()->keyBy->id;
        $traductions = TraductionTreeResource::collection($traductions)->toArray([]);

        $pageTitle = $article->label;
        $pageDescription = $article->presentation;

        return view('site.skerlingo.article', ['pageTitle' => $pageTitle, 'pageDescription' => $pageDescription, 'traductions' => $traductions, 'article' => ResourcesBlogPost::collection([$article])->toArray([])[0]])
            ->withPost($article)
            ->withCanonical($article->url);
    }

    public function new_request(Request $request)
    {
        return $this->requests($request, true);
    }

    public function requests(Request $request, $new_rfq = false)
    {

        Session::forget(['rfq_product', 'inscription_b2b', 'new_b2b_meeting']);

        $requests = Rfq::where(function ($query) use ($request) {
            $query->where('published', true);
        })->orderBy('created_at', 'desc')->get();

        $rubriques = RubriqueTreeResource::collection(Rubrique::where('secteur', 1)->whereNull('parent_id')->orderBy('ordre')->get())->toArray([]);
        $requests = RfqResource::collection($requests)->toArray([]);

        $pageTitle = 'Requests';


        $traductions = Traduction::where(function ($query) {
            $query->whereIn('rubrique_id', [16, 19]);
        })->orderBy('ordre')->get()->keyBy->id;
        $traductions = TraductionTreeResource::collection($traductions)->toArray([]);

        return view('site.skerlingo.requests', ['traductions' => $traductions, 'new_rfq' => $new_rfq, 'requests' => $requests, 'rubriques' => $rubriques, 'pageTitle' => $pageTitle]);
    }

    public function meetings(Request $request)
    {


        Session::forget(['rfq_product', 'rfq_normal', 'new_b2b_meeting']);

        $meetings = B2bMeeting::where(function ($query) use ($request) {
            $query->where('published', true);
        })->orderBy('created_at', 'desc')->get();

        $pageTitle = 'B2B Meetings';

        $rubriques = RubriqueTreeResource::collection(Rubrique::where('secteur', 1)->whereNull('parent_id')->orderBy('ordre')->get())->toArray([]);
        $meetings = B2bMeetingResource::collection($meetings)->toArray([]);

        return view('site.skerlingo.meetings', ['meetings' => $meetings, 'rubriques' => $rubriques, 'pageTitle' => $pageTitle]);
    }

    public function produit_page($id, $slug = '')
    {
        $produit = Produit::findOrFail($id);
        if ($slug !== $produit->alias) {
            return redirect()->to($produit->url);
        }

        $produits = Produit::where(function ($query) use ($id, $produit) {
            $query->whereNotNull('validation_skerlingo_date');
            $query->whereNotNull('validation_entreprise_date');
            $query->where('secteur_id', $produit->secteur_id);
            $query->where('id', '!=', $produit->id);
        })->get();

        $produits = ProduitResource::collection($produits)->toArray([]);


        $traductions = Traduction::where(function ($query) {
            $query->whereIn('rubrique_id', [17]);
        })->orderBy('ordre')->get()->keyBy->id;
        $traductions = TraductionTreeResource::collection($traductions)->toArray([]);

        return view('site.skerlingo.produit', ['traductions' => $traductions, 'produits' => $produits, 'produit' => ProduitResource::collection([$produit])->toArray([])[0]])
            ->withPost($produit)
            ->withCanonical($produit->url);
    }

    public function rfq_page($id, $slug = '')
    {
        $rfq = Rfq::findOrFail($id);
        if ($rfq->alias && $slug !== $rfq->alias) {
            return redirect()->to($rfq->url);
        }

        $rfqs = Rfq::where(function ($query) use ($id, $rfq) {
            $query->where('published', true);
            $query->where('secteur_id', $rfq->secteur_id);
            $query->where('id', '!=', $rfq->id);
        })->get();

        $rfqs = RfqResource::collection($rfqs)->toArray([]);

        $traductions = Traduction::where(function ($query) {
            $query->whereIn('rubrique_id', [16, 19, 20]);
        })->orderBy('ordre')->get()->keyBy->id;
        $traductions = TraductionTreeResource::collection($traductions)->toArray([]);

        return view('site.skerlingo.rfq', ['traductions' => $traductions, 'rfqs' => $rfqs, 'rfq' => RfqResource::collection([$rfq])->toArray([])[0]])
            ->withPost($rfq)
            ->withCanonical($rfq->url);
    }

    public function b2b_page($id, $slug = '')
    {
        $meeting = B2bMeeting::findOrFail($id);
        if ($meeting->alias && $slug !== $meeting->alias) {
            return redirect()->to($meeting->url);
        }

        $meetings = B2bMeeting::where(function ($query) use ($id, $meeting) {
            $query->where('published', true);
            $query->where('secteur_id', $meeting->secteur_id);
            $query->where('id', '!=', $meeting->id);
        })->get();

        $meetings = B2bMeetingResource::collection($meetings)->toArray([]);

        return view('site.skerlingo.meeting', ['meetings' => $meetings, 'meeting' => B2bMeetingResource::collection([$meeting])->toArray([])[0]])
            ->withPost($meeting)
            ->withCanonical($meeting->url);
    }


    public function test()
    {

        $data = Excel::import(new QuartiersImport(''), public_path('quartiers.xlsx'));
        exit('yes ok');

        $data = ['message' => 'This is a test!'];

        //Mail::to('abdellah.elaz@gmail.com')->send(new TestEmail($data));
    }


    public function contact_page(Request $request)
    {

        $traductions = Traduction::where(function ($query) {
            $query->whereIn('rubrique_id', [25, 13, 14, 22, 23]);
        })->orderBy('ordre')->get()->keyBy->id;
        $traductions = TraductionTreeResource::collection($traductions)->toArray([]);
        $pays = App\Pays::get();

        return view('site.skerlingo.contact', ['navDark' => true, 'traductions' => $traductions, 'pays' => $pays]);
    }

    public function contact_form(Request $request)
    {

        if ($request->get('raison_form'))
            exit;

        $rules = [
            //'nom' => 'required',
            'email' => ['required'],
            //'sujet' => 'required',
            //'message' => 'required',
            //'company_name' => 'required',
            //'country' => 'required',
        ];

        $contact = new Contact();

        $validator = Validator::make($request->all(), $rules);
        if (!$validator->fails()) {

            $contact->nom =  $request->get('nom');
            $contact->prenom =  $request->get('prenom');
            $contact->email =  $request->get('email');
            $contact->tel =  $request->get('tel');
            $contact->sujet =  $request->get('sujet');
            $contact->message =  $request->get('message');
            $contact->pays_id =  $request->get('country');
            $contact->company =  $request->get('company_name');
            $contact->fonction =  $request->get('fonction');
            $contact->ville =  $request->get('ville');
            $contact->save();

            $admins = User::where(function ($query) use ($request) {
                $query->where('id', 2);
            })->get();


            foreach ($admins as $item) {
                //$item->notify(new App\Notifications\contactPageNotification($contact));
            }


            $traductions = Traduction::where(function ($query) {
                $query->whereIn('rubrique_id', [25]);
            })->orderBy('ordre')->get()->keyBy->id;
            $traductions = TraductionTreeResource::collection($traductions)->toArray([]);

            if ($request->get('type') == 'download') {
                return ['success' => true, 'url' => asset('assets/site/skerlingo/boost-sales-b608a98b8d889db42a.pdf'),  'title' => 'Merci pour votre confiance.', 'message' => ''];
            }
            return ['success' => true,  'title' => 'Merci pour votre demande, bien reçu.', 'message' => 'Un membre de l\'équipe vérifiera votre demande dès que possible.'];
        } else {
            return ['success' => false, 'title' => 'Bienvenue Chez PERFOBOOST !', 'message' => 'Une erreur s\'est produite !', 'errors' => $validator->errors()];
        }
    }

    public function form_inscription(Request $request)
    {

        $rules = [
            'nom' => 'required',
            'prenom' => 'required',
            'email' => ['required', 'confirmed', 'email', Rule::unique('users')],
            'tel' => ['required', Rule::unique('users')]
        ];

        if ($request->get('type') == 'importer') {
            $rules['country'] = 'required';
        }

        $niceNames = [
            'nom' => 'Last name',
            'prenom' => 'First name',
            'country' => 'Country',
            'email' => 'Email adress',
            'tel' => 'Phone number'
        ];

        $user = new User();

        $validator = Validator::make($request->all(), $rules, [], $niceNames);
        if (!$validator->fails()) {

            $password = Str::random(10);
            $user->prenom =  $request->get('prenom');
            $user->nom =  $request->get('nom');
            $user->email =  $request->get('email');
            $user->role_id = $request->get('exporter') || $request->get('type') == 'exporter' ? 2 : 3;
            $user->enabled = true;
            $user->password =  Hash::make($password);
            $user->tel =  $request->get('tel');
            $user->pays_id =  $request->get('country') ? $request->get('country') : 118;
            $user->company =  $request->get('company_name');
            $user->secteurs =  $request->get('secteurs_id') ? implode(',', $request->get('secteurs_id')) : null;
            $user->save();

            if ($request->get('exporter') || $request->get('type') == 'exporter') {
                $entreprise = new Entreprise();
                $entreprise->statut_id =  1;

                $entreprise->ville_id =  null;
                $entreprise->secteur_id =  null;
                $entreprise->label =  $request->get('company_name');
                $entreprise->email =  ($request->get('email') != 'null') ? $request->get('email') : null;
                $entreprise->presentation =  null;
                $entreprise->tel =  ($request->get('tel') != 'null') ? $request->get('tel') : null;
                $entreprise->allow_add_products =  false;
                $entreprise->allow_get_rfq =  false;
                $entreprise->save();

                $user->entreprise_id =  $entreprise->id;
                $user->save();

                $traking = new EntrepriseTraking();
                $traking->statut_id =  1;
                $traking->entreprise_id =  $entreprise->id;
                $traking->user_id =  $user->id;
                $traking->commentaire =  '';
                $traking->save();

                $admins = User::where(function ($query) use ($request) {
                    $query->where('role_id', 1);
                })->get();

                $user->notify(new App\Notifications\NewRegisterToExporterNotification(''));
                foreach ($admins as $item) {
                    $item->notify(new App\Notifications\NewRegisterToAdminNotification($entreprise));
                }

                return ['success' => true, 'exporter_register' => true, 'title' => 'Thanks for your request of registration, well received.', 'message' => 'A member team will contact you asap to approve your registration.'];
            }

            if (Session::has('rfq_product')) {
                $rfq = session('rfq_product');
                $rfq->importer_id = $user->id;
                $rfq->pays_id = $user->pays_id;
                $rfq->statut_id =  1;
                $rfq->save();

                $rfq_entreprise = new RfqEntreprise();
                $rfq_entreprise->rfq_id =  $rfq->id;
                $rfq_entreprise->entreprise_id =  $rfq->entreprise_id;
                $rfq_entreprise->send_after =  0;
                $rfq_entreprise->proposal =  1;
                $rfq_entreprise->sent =  true;
                $rfq_entreprise->save();

                $admins = User::where(function ($query) use ($request) {
                    $query->where('role_id', 1);
                })->get();
                foreach ($admins as $item) {
                    $item->notify(new App\Notifications\NewRfqProductRequestToAdminNotification($rfq));
                }
                $user->notify(new App\Notifications\NewRfqProductRequestNotification($rfq));
                $user->notify(new App\Notifications\sendTemporaryPasswordNotification($password));

                Session::forget('rfq_product');

                return ['success' => true, 'rfq_product' => true, 'title' => 'Thanks for your Request For Quotation, Well received.', 'message' => 'A team member will check your RFQ asap and share it with the Moroccan company.'];
            } elseif (Session::has('inscription_b2b')) {

                $entreprise = $user->entreprise;

                $inscription = session('inscription_b2b');
                $inscription->user_id = $user->id;
                $inscription->entreprise_id =  $entreprise ? $entreprise->id : null;
                $inscription->save();

                Session::forget('inscription_b2b');

                return ['success' => true, 'inscription_b2b' => true, 'title' => 'Thanks for your Subscribtion , Well received.', 'message' => 'A team member will check your subscription asap.'];
            } elseif (Session::has('rfq_normal')) {
                $rfq = session('rfq_normal');
                $rfq->importer_id = $user->id;
                $rfq->pays_id = $user->pays_id;
                $rfq->statut_id =  1;
                $rfq->save();

                $admins = User::where(function ($query) use ($request) {
                    $query->where('role_id', 1);
                })->get();
                foreach ($admins as $item) {
                    $item->notify(new App\Notifications\NewRfqDirectRequestToAdminNotification($rfq));
                }

                $user->notify(new App\Notifications\NewRfqDirectRequestNotification($rfq));
                $user->notify(new App\Notifications\sendTemporaryPasswordNotification($password));

                Session::forget('rfq_normal');

                return ['success' => true, 'rfq_normal' => true, 'title' => 'Thanks for your Request For Quotation, Well received.', 'message' => 'A team member will check your RFQ asap and share it with the verified Moroccan exporters.'];
            } elseif (Session::has('new_b2b_meeting')) {
                $meeting = session('new_b2b_meeting');
                $meeting->importer_id = $user->id;
                $meeting->save();

                $user->notify(new App\Notifications\sendTemporaryPasswordNotification($password));

                Session::forget('new_b2b_meeting');

                return ['success' => true, 'rfq_normal' => true, 'title' => 'Thanks for your Request For B2B Meeting, Well received.', 'message' => 'A team member will check your Request asap.'];
            } else {

                /*
                $user->notify(new App\Notifications\sendTemporaryPasswordNotification($password));
                $admins = User::where(function ($query) use ($request) {
                    $query->where('role_id', 1);
                })->get();
                foreach ($admins as $item) {
                    $item->notify(new App\Notifications\NewImporterToAdminNotification($user));
                }
                */

                return ['success' => true, 'exporter_register' => true, 'signin_button' => true,  'title' => 'Thanks for your request of registration, well received.', 'message' => 'your password will be sent in a moment.'];
            }
        } else {
            return ['success' => false, 'title' => 'Bienvenue Chez skerlingo !', 'message' => 'Une erreur s\'est produite !', 'errors' => $validator->errors()];
        }

        return ['success' => true, 'title' => 'Bienvenue Chez skerlingo !', 'message' => 'Votre compte a été crée avec succès. Nos conseillers prendront contact avec vous dans les 24 heures !'];
    }

    public function form_login(Request $request)
    {

        $rules = [
            'password' => 'required',
            'email' => ['required', 'email', Rule::unique('users')],
        ];

        $niceNames = [
            'password' => 'Password',
            'email' => 'Email adress'
        ];

        $credentials = $request->only('email', 'password');

        if ($token = $this->guard()->attempt($credentials)) {
            $user = $this->guard()->user();

            /*
            $client = $user->client;
            if ($client && !$client->enabled) {
                return response()->json(['error' => 'Votre compte est bloqué. Merci de contacter le service concerné.'], 422);
            }
            if (!$client && !$user->enabled) {
                return response()->json(['error' => 'Votre compte est bloqué. Merci de contacter le service concerné.'], 422);
            }
            */

            if (Session::has('rfq_product')) {

                if ($user->role_id == 2) {
                    return ['success' => true, 'rfq_product' => true, 'token' => $token, 'title' => 'Un exportateur ne peut pas envoyer une demande de devis pour un produit ou un service.', 'message' => 'Cette action est réservée uniquement pour les importateurs internationaux'];
                }
                if ($user->role_id == 1) {
                    return ['success' => true, 'logged_in' => true, 'title' => 'Un administrateur ne peut pas envoyer une demande de devis pour un produit ou un service.', 'message' => 'Cette action est réservée uniquement pour les importateurs internationaux'];
                }

                $rfq = session('rfq_product');
                $rfq->importer_id = $user->id;
                $rfq->pays_id = $user->pays_id;
                $rfq->statut_id =  1;
                $rfq->save();

                $rfq_entreprise = new RfqEntreprise();
                $rfq_entreprise->rfq_id =  $rfq->id;
                $rfq_entreprise->entreprise_id =  $rfq->entreprise_id;
                $rfq_entreprise->send_after =  0;
                $rfq_entreprise->proposal =  1;
                $rfq_entreprise->sent =  true;
                $rfq_entreprise->save();

                $admins = User::where(function ($query) use ($request) {
                    $query->where('role_id', 1);
                })->get();
                foreach ($admins as $item) {
                    $item->notify(new App\Notifications\NewRfqProductRequestToAdminNotification($rfq));
                }
                $user->notify(new App\Notifications\NewRfqProductRequestNotification($rfq));

                Session::forget('rfq_product');

                return ['success' => true, 'rfq_product' => true, 'token' => $token, 'title' => 'Thanks for your Request For Quotation, Well received.', 'message' => 'A team member will check your RFQ asap and share it with the Moroccan company.'];
            }

            if (Session::has('rfq_quote')) {

                if ($user->role_id == 3) {
                    return ['success' => true, 'rfq_quote' => true, 'token' => $token, 'title' => 'An importer cannot submit a quote.', 'message' => 'This action is reserved only for Moroccan exporters'];
                }
                if ($user->role_id == 1) {
                    return ['success' => true, 'logged_in' => true, 'title' => 'Un administrateur ne peut pas faire des propositions de devis.', 'message' => 'Cette action est réservée uniquement pour les exportateurs Marocains.'];
                }

                $entreprise = $user->entreprise;

                $rfq_entreprise = session('rfq_quote');
                $rfq_entreprise->entreprise_id = $entreprise->id;
                $rfq_entreprise->send_after =  0;
                $rfq_entreprise->sent =  true;
                $rfq_entreprise->proposal =  true;
                $rfq_entreprise->save();

                $rfq_entreprise->rfq->importer->notify(new \App\Notifications\NewExporterMessageRfqDirectNotification($rfq_entreprise->rfq));

                Session::forget('rfq_quote');

                return ['success' => true, 'rfq_quote' => true, 'token' => $token, 'title' => 'Thanks for sending the Quote, Well received.', 'message' => 'A team member will check your RFQ asap.'];
            }

            if (Session::has('rfq_normal')) {

                if ($user->role_id == 2) {
                    return ['success' => true, 'rfq_normal' => true, 'token' => $token, 'title' => 'Un exportateur ne peut pas envoyer une demande de devis.', 'message' => 'Cette action est réservée uniquement pour les importateurs internationaux'];
                }
                if ($user->role_id == 1) {
                    return ['success' => true, 'logged_in' => true, 'title' => 'Un administrateur ne peut pas envoyer une demande de devis.', 'message' => 'Cette action est réservée uniquement pour les importateurs internationaux'];
                }

                $rfq = session('rfq_normal');
                $rfq->importer_id = $user->id;
                $rfq->pays_id = $user->pays_id;
                $rfq->statut_id =  1;
                $rfq->save();

                $admins = User::where(function ($query) use ($request) {
                    $query->where('role_id', 1);
                })->get();
                foreach ($admins as $item) {
                    $item->notify(new App\Notifications\NewRfqDirectRequestToAdminNotification($rfq));
                }
                $user->notify(new App\Notifications\NewRfqDirectRequestNotification($rfq));

                Session::forget('rfq_normal');

                return ['success' => true, 'rfq_normal' => true, 'token' => $token, 'title' => 'Thanks for your Request For Quotation, Well received.', 'message' => 'A team member will check your RFQ asap and share it with the verified Moroccan exporters.'];
            }

            if (Session::has('inscription_b2b')) {

                $entreprise = $user->entreprise;

                $inscription = session('inscription_b2b');
                $inscription->user_id = $user->id;
                $inscription->entreprise_id =  $entreprise ? $entreprise->id : null;
                $inscription->save();

                Session::forget('inscription_b2b');

                return ['success' => true, 'inscription_b2b' => true, 'title' => 'Thanks for your Subscribtion , Well received.', 'message' => 'A team member will check your subscription asap.'];
            }

            if (Session::has('new_b2b_meeting')) {
                $meeting = session('new_b2b_meeting');
                $meeting->importer_id = $user->id;
                $meeting->save();

                Session::forget('new_b2b_meeting');

                return ['success' => true, 'rfq_normal' => true, 'title' => 'Thanks for your Request For B2B Meeting, Well received.', 'message' => 'A team member will check your Request asap.'];
            }

            return ['success' => true,  'token' => $token, 'redirect' => route('home_page')];
        }


        return ['success' => false, 'errors' => ['email' => 'Email ou mot de passe incorect'], 'title' => 'Bienvenue Chez skerlingo !', 'message' => 'Votre compte a été crée avec succès. Nos conseillers prendront contact avec vous dans les 24 heures !'];
    }

    public function logout()
    {

        if ($this->guard())
            $this->guard()->logout();

        if (isset($_COOKIE['auth_token_default'])) {
            unset($_COOKIE['auth_token_default']);
            setcookie('auth_token_default', null, -1, '/');
        }

        return ['redirect' => route('home_page')];
    }

    public function product_send_msg_form(Request $request)
    {

        $rules = [
            'sujet' => 'required',
            'message' => 'required',
        ];

        $niceNames = [
            'sujet' => 'Subject',
            'message' => 'Message',
        ];

        $validator = Validator::make($request->all(), $rules, [], $niceNames);
        if (!$validator->fails()) {

            $user = $this->guard()->user();

            $produit = Produit::findOrFail($request->get('produit'));

            $rfq = new Rfq();
            $rfq->code =  strtoupper(Str::random(10));
            $rfq->sujet =  $request->get('sujet');
            $rfq->message =  $request->get('message');
            $rfq->entreprise_id =  $produit->entreprise ? $produit->entreprise->id : null;
            $rfq->produit_id =  $produit->id;
            $rfq->secteur_id =  $produit->secteur->id;

            if ($user) {

                if ($user->role_id == 2) {
                    return ['success' => true, 'logged_in' => true, 'title' => 'Un exportateur ne peut pas envoyer une demande de devis pour un produit ou un service.', 'message' => 'Cette action est réservée uniquement pour les importateurs internationaux'];
                }
                if ($user->role_id == 1) {
                    return ['success' => true, 'logged_in' => true, 'title' => 'Un administrateur ne peut pas envoyer une demande de devis pour un produit ou un service.', 'message' => 'Cette action est réservée uniquement pour les importateurs internationaux'];
                }

                $rfq->importer_id = $user->id;
                $rfq->pays_id = $user->pays_id;
                $rfq->statut_id =  1;
                $rfq->save();

                $rfq_entreprise = new RfqEntreprise();
                $rfq_entreprise->rfq_id =  $rfq->id;
                $rfq_entreprise->entreprise_id =  $rfq->entreprise_id;
                $rfq_entreprise->send_after =  0;
                $rfq_entreprise->proposal =  1;
                $rfq_entreprise->sent =  true;
                $rfq_entreprise->save();

                $admins = User::where(function ($query) use ($request) {
                    $query->where('role_id', 1);
                })->get();
                foreach ($admins as $item) {
                    $item->notify(new App\Notifications\NewRfqProductRequestToAdminNotification($rfq));
                }
                $user->notify(new App\Notifications\NewRfqProductRequestNotification($rfq));

                return ['success' => true, 'logged_in' => true, 'title' => 'Thanks for your Request For Quotation, Well received.', 'message' => 'A team member will check your RFQ asap and share it with the Moroccan company.'];
            } else {

                Session::put('rfq_product', $rfq);

                return ['success' => true, 'logged_in' => false, 'modal_title' => 'You have to log in to send your message'];
            }
        } else {
            return ['success' => false, 'title' => 'Bienvenue Chez skerlingo !', 'message' => 'Une erreur s\'est produite !', 'errors' => $validator->errors()];
        }

        return ['success' => true, 'title' => 'Bienvenue Chez skerlingo !', 'message' => 'Votre compte a été crée avec succès. Nos conseillers prendront contact avec vous dans les 24 heures !'];
    }


    public function b2b_send_msg_form(Request $request)
    {

        $rules = [];

        $validator = Validator::make($request->all(), $rules);
        if (!$validator->fails()) {

            $user = $this->guard()->user();

            $meeting = B2bMeeting::findOrFail($request->get('meeting'));

            $inscription = new B2bInscription();
            $inscription->message =  $request->get('message');
            $inscription->meeting_id =  $meeting->id;

            if ($user) {
                $entreprise = $user->entreprise;
                $inscription->entreprise_id =  $entreprise ? $entreprise->id : null;
                $inscription->save();

                return ['success' => true, 'logged_in' => true, 'title' => 'Thanks for your Subscribtion , Well received.', 'message' => 'A team member will check your subscription asap.'];
            } else {

                Session::put('inscription_b2b', $inscription);

                return ['success' => true, 'logged_in' => false, 'modal_title' => 'You have to log in for subscribe to b2b meeting'];
            }
        } else {
            return ['success' => false, 'title' => 'Bienvenue Chez skerlingo !', 'message' => 'Une erreur s\'est produite !', 'errors' => $validator->errors()];
        }

        return ['success' => true, 'title' => 'Bienvenue Chez skerlingo !', 'message' => 'Votre compte a été crée avec succès. Nos conseillers prendront contact avec vous dans les 24 heures !'];
    }


    public function rfq_send_quote_form(Request $request)
    {

        $rules = [];

        $validator = Validator::make($request->all(), $rules);
        if (!$validator->fails()) {

            $user = $this->guard()->user();

            $rfq = Rfq::findOrFail($request->get('rfq'));

            $rfq_entreprise = new RfqEntreprise();
            $rfq_entreprise->rfq_id =  $rfq->id;

            if ($user) {

                if ($user->role_id == 3) {
                    return ['success' => true, 'logged_in' => true, 'title' => 'An importer cannot submit a quote.', 'message' => 'This action is reserved only for Moroccan exporters'];
                }
                if ($user->role_id == 1) {
                    return ['success' => true, 'logged_in' => true, 'title' => 'Un administrateur ne peut pas faire des propositions de devis.', 'message' => 'Cette action est réservée uniquement pour les exportateurs Marocains.'];
                }

                $entreprise = $user->entreprise;
                $rfq_entreprise->send_after =  0;
                $rfq_entreprise->sent =  true;
                $rfq_entreprise->proposal =  true;
                $rfq_entreprise->entreprise_id =  $entreprise ? $entreprise->id : null;
                $rfq_entreprise->save();

                return ['success' => true, 'logged_in' => true, 'title' => 'Thanks for sending the Quote , Well received.', 'message' => 'A team member will check it asap.'];
            } else {

                Session::put('rfq_quote', $rfq_entreprise);

                return ['success' => true, 'logged_in' => false, 'modal_title' => 'You have to log in to send a quote'];
            }
        } else {
            return ['success' => false, 'title' => 'Bienvenue Chez skerlingo !', 'message' => 'Une erreur s\'est produite !', 'errors' => $validator->errors()];
        }

        return ['success' => true, 'title' => 'Bienvenue Chez skerlingo !', 'message' => 'Votre compte a été crée avec succès. Nos conseillers prendront contact avec vous dans les 24 heures !'];
    }

    public function request_send_msg_form(Request $request)
    {

        $rules = [
            'sujet' => 'required',
            'message' => 'required',
            'sector' => 'required_if:rubrique,""',
        ];
        $niceNames = [
            'sujet' => 'Subject',
            'message' => 'Message',
            'sector' => 'Sector',
            'rubrique' => 'Category',
        ];

        $validator = Validator::make($request->all(), $rules, [], $niceNames);
        if (!$validator->fails()) {

            $user = $this->guard()->user();

            $rfq = new Rfq();
            $rfq->code =  strtoupper(Str::random(10));
            $rfq->sujet =  $request->get('sujet');
            $rfq->message =  $request->get('message');
            $rfq->secteur_id =  $request->get('rubrique') ? $request->get('rubrique') : $request->get('sector');

            if ($user) {

                if ($user->role_id == 2) {
                    return ['success' => true, 'logged_in' => true, 'title' => 'Un exportateur ne peut pas envoyer une demande de devis.', 'message' => 'Cette action est réservée uniquement pour les importateurs internationaux'];
                }
                if ($user->role_id == 1) {
                    return ['success' => true, 'logged_in' => true, 'title' => 'Un administrateur ne peut pas envoyer une demande de devis.', 'message' => 'Cette action est réservée uniquement pour les importateurs internationaux'];
                }

                $rfq->importer_id = $user->id;
                $rfq->pays_id = $user->pays_id;
                $rfq->statut_id =  1;
                $rfq->save();

                $admins = User::where(function ($query) use ($request) {
                    $query->where('role_id', 1);
                })->get();
                foreach ($admins as $item) {
                    $item->notify(new App\Notifications\NewRfqDirectRequestToAdminNotification($rfq));
                }
                $user->notify(new App\Notifications\NewRfqDirectRequestNotification($rfq));

                return ['success' => true, 'logged_in' => true, 'title' => 'Thanks for your Request For Quotation, Well received.', 'message' => 'A team member will check your RFQ asap and share it with the verified Moroccan exporters.'];
            } else {
                Session::put('rfq_normal', $rfq);
                return ['success' => true, 'logged_in' => false, 'modal_title' => 'You have to log in to create a new request'];
            }
        } else {
            return ['success' => false, 'title' => 'Bienvenue Chez skerlingo !', 'message' => 'Une erreur s\'est produite !', 'errors' => $validator->errors()];
        }

        return ['success' => true, 'title' => 'Bienvenue Chez skerlingo !', 'message' => 'Votre compte a été crée avec succès. Nos conseillers prendront contact avec vous dans les 24 heures !'];
    }



    public function new_b2b_form(Request $request)
    {

        $rules = [
            'sujet' => 'required',
            'message' => 'required',
            'rubrique' => 'required',
        ];
        $niceNames = [
            'sujet' => 'Subject',
            'message' => 'Message',
            'rubrique' => 'Category',
        ];

        $validator = Validator::make($request->all(), $rules, [], $niceNames);
        if (!$validator->fails()) {

            $user = $this->guard()->user();

            $meeting = new B2bMeeting();
            $meeting->sujet =  $request->get('sujet');
            $meeting->message =  $request->get('message');
            $meeting->date_debut =  ($request->get('date_debut') != 'null') ? $request->get('date_debut') : null;
            $meeting->date_fin =  ($request->get('date_fin') != 'null') ? $request->get('date_fin') : null;
            $meeting->secteur_id =  $request->get('rubrique');

            if ($user) {
                $meeting->importer_id = $user->id;
                $meeting->save();

                return ['success' => true, 'logged_in' => true, 'title' => 'Thanks for your Request For Quotation, Well received.', 'message' => 'A team member will check your RFQ asap and share it with the verified Moroccan exporters.'];
            } else {
                Session::put('new_b2b_meeting', $meeting);
                return ['success' => true, 'logged_in' => false, 'modal_title' => 'You have to log in to request for a b2b meeting'];
            }
        } else {
            return ['success' => false, 'title' => 'Bienvenue Chez skerlingo !', 'message' => 'Une erreur s\'est produite !', 'errors' => $validator->errors()];
        }

        return ['success' => true, 'title' => 'Bienvenue Chez skerlingo !', 'message' => 'Votre compte a été crée avec succès. Nos conseillers prendront contact avec vous dans les 24 heures !'];
    }


    private function guard()
    {
        return Auth::guard();
    }
}
