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

Route::get('/admin', 'AdminController@index')->name('admin');
Route::get('/admin/landing-page', 'AdminController@index')->name('landing-page');
Route::get('/admin/about-us', 'AdminController@about')->name('about');

Route::get('/admin/projects', 'ProjectController@index')->name('projects.index');
Route::get('/admin/project/{id}', 'ProjectController@get')->name('projects.get');
Route::post('/admin/project/store', 'ProjectController@store')->name('projects.create');
Route::post('/admin/project/store/{id}', 'ProjectController@store')->name('projects.store');
Route::post('/admin/project/destroy/{id}', 'ProjectController@destroy')->name('projects.destroy');
