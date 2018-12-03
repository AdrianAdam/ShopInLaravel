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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/samsung', function () {
    $produse = DB::table('produse')->where('idProducato', '1')->get();
    return view('samsung', ['produse'=>$produse]);
});

Route::get('/apple', function () {
    $produse = DB::table('produse')->where('idProducato', '2')->get();
    return view('apple', ['produse'=>$produse]);
});

Route::get('/oneplus', function () {
    $produse = DB::table('produse')->where('idProducato', '3')->get();
    return view('oneplus', ['produse'=>$produse]);
});

Route::get('/shoppingcart', function() {
    $id = Auth::user()->id;
    $produseProducator = DB::table('produse')
                            ->join('producator', 'idProducato', '=', 'idProducator');
    $produse = DB::table('shoppingcart')
                            ->joinSub($produseProducator, 'produseProducator', function($join) {
                                $join->on('idProdusSC', '=', 'idProdus');
                            })
                            ->where('idUser', '=', $id)
                            ->get();
   return view('shoppingcart', ['produse'=>$produse]);
})->middleware('auth');

Route::get('/favourites', function() {
    $id = Auth::user()->id;
    $produseProducator = DB::table('produse')
        ->join('producator', 'idProducato', '=', 'idProducator');
    $produse = DB::table('favourites')
        ->joinSub($produseProducator, 'produseProducator', function($join) {
            $join->on('idProdusFav', '=', 'idProdus');
        })
        ->where('idUser', '=', $id)
        ->get();
    return view('favourites', ['produse'=>$produse]);
})->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');