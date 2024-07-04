<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    return redirect('app');
});
*/

Route::get('/app', function () {
    return view('welcome');
})->name('app_link');

Route::get('/', function () {
    $locale = session('locale') ?: config('app.fallback_locale');
    return redirect($locale);
})->name('base_path');

Route::middleware('locale')->group(function () {

    $langs = ['', 'fr'];
    foreach ($langs as $lang) {
        Route::get($lang . '/contact', 'SiteController@contact_page')->name('contact_page' . ($lang ? '_' . $lang : ''));

        Route::get($lang . '/', 'SiteController@index')->name('home_page' . ($lang ? '_' . $lang : ''));
        Route::get($lang . '/about', 'SiteController@about')->name('about_page' . ($lang ? '_' . $lang : ''));
        Route::get($lang . '/cgu', 'SiteController@cgu')->name('cgu_page' . ($lang ? '_' . $lang : ''));

        Route::get($lang . '/blog', 'SiteController@blog')->name('blog_page' . ($lang ? '_' . $lang : ''));
        Route::get($lang . '/blog/{id}/{slug?}', 'SiteController@blogpost_page')->name('blogpost_page' . ($lang ? '_' . $lang : ''));

        Route::get($lang . '/products', 'SiteController@products')->name('products_page' . ($lang ? '_' . $lang : ''));
        Route::get($lang . '/search-products', 'SiteController@search_products')->name('search_products' . ($lang ? '_' . $lang : ''));
        Route::get($lang . '/category/{id}/{slug?}', 'SiteController@products_category')->name('products_category_page' . ($lang ? '_' . $lang : ''));
        Route::get($lang . '/products/{id}/{slug?}', 'SiteController@produit_page')->name('produit_page' . ($lang ? '_' . $lang : ''));
        Route::get($lang . '/boost-sales', 'SiteController@boost_sales')->name('boost_sales_page' . ($lang ? '_' . $lang : ''));


        Route::get($lang . '/requests', 'SiteController@requests')->name('requests_page' . ($lang ? '_' . $lang : ''));
        Route::get($lang . '/requests/new-rfq', 'SiteController@new_request')->name('requests_new_page' . ($lang ? '_' . $lang : ''));
        Route::get($lang . '/requests/{id}/{slug?}', 'SiteController@request_page')->name('request_page' . ($lang ? '_' . $lang : ''));
        Route::get($lang . '/requests/{id}/{slug?}', 'SiteController@rfq_page')->name('rfq_page' . ($lang ? '_' . $lang : ''));

        Route::get($lang . '/b2b-meetings', 'SiteController@meetings')->name('meetings_page' . ($lang ? '_' . $lang : ''));
        Route::get($lang . '/b2b-meetings/{id}/{slug?}', 'SiteController@b2b_page')->name('b2b_page' . ($lang ? '_' . $lang : ''));
    }

    Route::post('/logout', 'SiteController@logout')->name('logout_form');

    Route::post('form_inscription', 'SiteController@form_inscription')->name('sign_up_form')->middleware('XSS');
    Route::post('form_login', 'SiteController@form_login')->name('sign_in_form')->middleware('XSS');

    Route::post('product_send_msg_form', 'SiteController@product_send_msg_form')->name('product_send_msg_form')->middleware('XSS');

    Route::post('request_send_msg_form', 'SiteController@request_send_msg_form')->name('request_send_msg_form')->middleware('XSS');
    Route::post('rfq_send_quote_form', 'SiteController@rfq_send_quote_form')->name('rfq_send_quote_form')->middleware('XSS');

    Route::post('b2b_send_msg_form', 'SiteController@b2b_send_msg_form')->name('b2b_send_msg_form')->middleware('XSS');
    Route::post('new_b2b_form', 'SiteController@new_b2b_form')->name('new_b2b_form')->middleware('XSS');
    Route::post('contact_form', 'SiteController@contact_form')->name('contact_form')->middleware('XSS');
});

Route::get('/inscription', function () {
    return redirect('app');
});

//Route::get('/', 'SiteController@index')->name('site');

Route::get('/admin0619', function () {
    return view('welcome');
})->name('app_link');

Route::get('/tv/{any?}', function () {
    return view('welcome');
});

// Route to handle page reload in Vue except for api routes
Route::get('/admin0619/{any?}', function () {
    return view('welcome');
})->where('any', '^(?!api\/)[\/\w\.-]*');



Route::get('{any?}', function () {
    return view('web');
})->where('any', '^(?!api\/)[\/\w\.-]*');

/*
Route::resource('contacts', 'ContactController')->middleware('auth');
Route::resource('professeurs', 'ProfesseurController')->middleware('auth');
Route::resource('prestationcategories', 'PrestationCategorieController')->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home');
*/
