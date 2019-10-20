<?php

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

use Illuminate\Support\Facades\Route;

Route::get('/', 'WelcomeController@index')->name('welcome');

Route::get('/about-us', 'AboutController@index')->name('about-us');
Route::get('/what-we-do', 'AboutController@index')->name('what-we-do');
Route::get('/our-people', 'AboutController@index')->name('our-people');
Route::get('/our-knowledge', 'AboutController@index')->name('our-knowledge');
Route::get('/news', 'AboutController@index')->name('news');
Route::get('/events', 'AboutController@index')->name('events');
Route::get('/contact-us', 'AboutController@index')->name('contact-us');
Route::get('/video', 'VideosController@video')->name('videos');

Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminController@index')->name('admin.index');

    Route::prefix('landing-page')->group(function () {
        Route::get('slides', 'Admin\LandingPageController@index')
            ->name('admin.landing-page.index');

        Route::get('slide/{id}', 'Admin\LandingPageController@get')
            ->name('admin.landing-page.get');

        Route::post('slide/store', 'Admin\LandingPageController@store')
            ->name('admin.landing-page.store');

        Route::post('slide/store/{id}', 'Admin\LandingPageController@store')
            ->name('admin.landing-page.store');

        Route::post('slide/destroy', 'Admin\LandingPageController@destroy')
            ->name('admin.landing-page.destroy');
    });

    Route::prefix('about-us')->group(function () {
      Route::post('store-settings', 'Admin\AboutUsController@storeSettings')
            ->name('admin.about-us.store-settings');

        Route::post('store-sections', 'Admin\AboutUsController@storeSections')
            ->name('admin.about-us.store-sections');
    });

    Route::get('manage/{element}', 'LayoutSizeController@index')->name('layout.index');
    Route::post('manage/{element}/store', 'LayoutSizeController@store')->name('layout.index');
});
