<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('auth')->group(function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::get('refresh', 'AuthController@refresh');
    // Send reset password mail
    Route::post('reset-password', 'AuthController@sendPasswordResetLink');

    // handle reset password form process
    Route::post('reset/password', 'AuthController@callResetPassword');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('user', 'AuthController@user');
        Route::post('logout', 'AuthController@logout');
    });
});

Route::prefix('mngr')->group(function () {

    Route::prefix('account')->group(function () {
        Route::post('register', 'AuthMngrController@register');
        Route::post('login', 'AuthMngrController@login');
    });

    Route::get('splash', 'HomeMngrController@splash');
    Route::group(['middleware' => 'MobileMngr'], function () {
        Route::get('home', 'HomeMngrController@index');
        Route::get('bons_retour', 'HomeMngrController@bons_retour');
        Route::get('boxes', 'HomeMngrController@boxes');
        Route::get('search_boxe', 'HomeMngrController@search_boxe');
        Route::get('search_colis', 'HomeMngrController@search_colis');
        Route::get('br', 'HomeMngrController@br');
        Route::post('save_res', 'HomeMngrController@save_res');
        Route::post('save_creneau', 'HomeMngrController@save_creneau');
        Route::post('submit_br', 'HomeMngrController@submit_br');


        Route::post('fcm_token', 'HomeMngrController@fcm_token');

        Route::group(['middleware' => 'auth:api'], function () {
            Route::post('giveaway_participate', 'HomeMngrController@giveaway_participate');
            Route::post('panier', 'HomeMngrController@panier');
            Route::get('profil', 'HomeMngrController@profil');
            Route::prefix('account')->group(function () {
                Route::get('profile', 'AuthMngrController@profile');
                Route::post('update', 'AuthMngrController@update');
            });
        });
    });
});

Route::prefix('v1')->group(function () {

    Route::prefix('account')->group(function () {
        Route::post('register', 'AuthMobileController@register');
        Route::post('login', 'AuthMobileController@login');
    });

    Route::get('splash', 'HomeMobileController@splash');
    Route::group(['middleware' => 'MobileMngr'], function () {
        Route::get('home', 'HomeMobileController@index');
        Route::get('colis', 'HomeMobileController@colis');
        Route::get('quiz', 'HomeMobileController@quiz');
        Route::get('quiz/{id}', 'HomeMobileController@quiz');
        Route::get('lecons', 'HomeMobileController@lecons');
        Route::get('grid/{id}', 'HomeMobileController@grid');
        Route::get('progress/{id}', 'HomeMobileController@progress');
        Route::get('lecons_introduction/{id}', 'HomeMobileController@lecons_introduction');
        Route::get('lecon', 'HomeMobileController@lecon');
        Route::get('form_colis', 'HomeMobileController@form_colis');
        Route::get('bons_livraison', 'HomeMobileController@bons_livraison');
        Route::post('submit_bl', 'HomeMobileController@submit_bl');
        Route::get('factures', 'HomeMobileController@factures');
        Route::get('search_boxe', 'HomeMobileController@search_boxe');
        Route::get('search_colis', 'HomeMobileController@search_colis');
        Route::get('bl', 'HomeMobileController@bl');
        Route::post('save_res', 'HomeMobileController@save_res');
        Route::post('save_creneau', 'HomeMobileController@save_creneau');
        Route::post('submit_colis', 'HomeMobileController@submit_colis');
        Route::get('contact', 'HomeMobileController@contact');


        Route::post('fcm_token', 'HomeMobileController@fcm_token');

        Route::group(['middleware' => 'auth:api'], function () {
            Route::post('giveaway_participate', 'HomeMobileController@giveaway_participate');
            Route::post('panier', 'HomeMobileController@panier');
            Route::get('profil', 'HomeMobileController@profil');
            Route::get('favorites', 'HomeMobileController@favorites');
            Route::post('favorite', 'HomeMobileController@favorite');
            Route::post('quiz_lettre', 'HomeMobileController@quiz_lettre');
            Route::prefix('account')->group(function () {
                Route::get('profile', 'AuthMobileController@profile');
                Route::post('update', 'AuthMobileController@update');
            });
        });
    });
});

Route::prefix('web')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('register', 'AuthWebController@register');
        Route::post('login', 'AuthWebController@login');
        Route::get('refresh', 'AuthWebController@refresh');

        Route::group(['middleware' => 'auth:api'], function () {
            Route::get('user', 'AuthWebController@user');
            Route::post('logout', 'AuthWebController@logout');
        });
    });

    Route::group(['middleware' => 'BorneMiddle'], function () {
        Route::get('home', 'HomeWebController@index');
        Route::get('services', 'HomeWebController@services');
        Route::get('sidebare', 'HomeWebController@sidebare');
    });
});

Route::get('etiquette', 'ColisController@etiquette');
Route::post('blog_articles/ckeditor_upload', 'BlogPostController@ckeditor_upload')->name('ckeditor.upload');
Route::group(['middleware' => 'auth:api'], function () {
    // Users

    Route::post('configurations/save_partie', 'ConfigurationController@save_partie')->middleware('isAdmin');
    Route::get('configurations/table', 'ConfigurationController@table')->middleware('isAdmin');

    Route::post('rubriques/save_order', 'RubriqueController@save_order')->middleware('isAdmin');
    Route::resource('rubriques', 'RubriqueController')->middleware('isAdmin');
    Route::post('slides/save_order', 'SlideController@save_order')->middleware('isAdmin');
    Route::resource('slides', 'SlideController')->middleware('isAdmin');
    Route::resource('blog_rubriques', 'BlogTypeController')->middleware('isAdmin');
    Route::resource('lecons', 'LeconController')->middleware('isAdmin');
    Route::resource('blog_articles', 'BlogPostController')->middleware('isAdmin');
    Route::get('users', 'UserController@index')->middleware('isAdmin');
    Route::get('users/{id}', 'UserController@show')->middleware('isAdminOrSelf');
    Route::post('utilisateurs/send_password', 'UtilisateurController@send_password')->middleware('isAdmin');
    Route::post('utilisateurs/change_password', 'UtilisateurController@change_password')->middleware('isAdmin');
    Route::resource('utilisateurs', 'UtilisateurController')->middleware('isAdmin');
    Route::get('importateurs/activer_compte', 'ImportateurController@activer_compte')->middleware('isAdmin');
    Route::get('importateurs/bloquer_compte', 'ImportateurController@bloquer_compte')->middleware('isAdmin');
    Route::get('importateurs/profile', 'ImportateurController@profile')->middleware('isAdmin');
    Route::post('importateurs/change_password', 'ImportateurController@change_password')->middleware('isAdmin');
    Route::resource('importateurs', 'ImportateurController')->middleware('isAdmin');
    Route::resource('villes', 'VilleController')->middleware('isAdmin');
    Route::resource('marques', 'MarqueController')->middleware('isAdmin');


    Route::post('lettres/update_descriptions', 'LettreController@update_descriptions')->middleware('isAdmin');
    Route::resource('lettres', 'LettreController')->middleware('isAdmin');

    Route::resource('event_formulaires', 'ContactController')->middleware('isAdmin');

    Route::post('traduction_rubriques/save_order', 'TraductionRubriqueController@save_order')->middleware('isAdmin');
    Route::resource('traduction_rubriques', 'TraductionRubriqueController')->middleware('isAdmin');
    Route::post('traductions/save_partie', 'TraductionController@save_partie')->middleware('isAdmin');
    Route::post('traductions/save_order', 'TraductionController@save_order')->middleware('isAdmin');
    Route::get('traductions/table', 'TraductionController@table')->middleware('isAdmin');
    Route::resource('traductions', 'TraductionController')->middleware('isAdmin');

    Route::get('rfqs/rcode', 'RfqController@find_by_code')->middleware('isAdmin');
    Route::post('rfqs/published', 'RfqController@published')->middleware('isAdmin');
    Route::post('rfqs/send_message', 'RfqController@send_message')->middleware('isAdmin');
    Route::post('rfqs/save_entreprises', 'RfqController@save_entreprises')->middleware('isAdmin');
    Route::get('rfqs/change_statut', 'RfqController@change_statut')->middleware('isAdmin');
    Route::get('rfqs/get_messages', 'RfqController@get_messages')->middleware('isAdmin');
    Route::resource('rfqs', 'RfqController')->middleware('isAdmin');

    Route::post('entreprises/traking_form', 'EntrepriseController@traking_form')->middleware('isAdmin');
    Route::get('entreprises/profile', 'EntrepriseController@profile')->middleware('isAdmin');
    Route::get('entreprises/password', 'EntrepriseController@password')->middleware('isAdmin');
    Route::post('entreprises/add_document', 'EntrepriseController@add_document')->middleware('isAdmin');
    Route::post('entreprises/change_password', 'EntrepriseController@change_password')->middleware('isAdmin');
    Route::get('entreprises/valider_entreprise', 'EntrepriseController@valider_entreprise')->middleware('isAdmin');
    Route::get('entreprises/activer_compte', 'EntrepriseController@activer_compte')->middleware('isAdmin');
    Route::get('entreprises/bloquer_compte', 'EntrepriseController@bloquer_compte')->middleware('isAdmin');
    Route::resource('entreprises', 'EntrepriseController')->middleware('isAdmin');

    Route::post('produits/delete_photo/{id}', 'ProduitController@delete_photo')->middleware('isAdmin');
    Route::post('produits/upload_photo', 'ProduitController@upload_photo')->middleware('isAdmin');
    Route::get('produits/valider_produit', 'ProduitController@valider_produit')->middleware('isAdmin');
    Route::get('produits/annuler_produit', 'ProduitController@annuler_produit')->middleware('isAdmin');
    Route::resource('produits', 'ProduitController')->middleware('isAdmin');

    Route::post('meetings/published', 'MeetingController@published')->middleware('isAdmin');
    Route::post('meetings/delete_photo/{id}', 'MeetingController@delete_photo')->middleware('isAdmin');
    Route::post('meetings/upload_photo', 'MeetingController@upload_photo')->middleware('isAdmin');
    Route::get('meetings/valider_produit', 'MeetingController@valider_produit')->middleware('isAdmin');
    Route::get('meetings/annuler_produit', 'MeetingController@annuler_produit')->middleware('isAdmin');
    Route::resource('meetings', 'MeetingController')->middleware('isAdmin');

    Route::resource('actualites', 'ActualiteController')->middleware('isAdmin');
    Route::get('header_admin', 'AgenceController@header_admin')->middleware('isAdmin');
    Route::get('menu_admin', 'AgenceController@menu_admin')->middleware('isAdmin');
    Route::resource('notifications', 'NotificationController')->middleware('isAdmin');
    Route::get('dashboard', 'StatisticController@dashboard')->middleware('isAdmin');
    Route::get('statistics', 'StatisticController@index')->middleware('isAdmin');
    Route::resource('profile', 'ProfileController');
    Route::post('change_password', 'ProfileController@change_password')->middleware('isAdmin');
});
