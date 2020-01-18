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

use Stichoza\GoogleTranslate\GoogleTranslate;

Route::get('/', function () {
    return view('welcome');
});


Route::get('google_translate/{word}/{lang}', function ($word, $lang) {
    $tr = new GoogleTranslate($lang);
    $text = $tr->translate($word);
    return $text;
});
