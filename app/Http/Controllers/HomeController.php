<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $produse = DB::table('orders')
            ->join('produse', 'idProdusOrder', '=', 'idProdus')
            ->where('idUserOrder', '=', $id)
            ->get();
        $max = DB::table('orders')->max('idProdusOrder');

        return view('home', ['produse' => $produse], ['max' => $max]);
    }
}
