<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Samsung</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .title {
                font-size: 84px;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .content {
                text-align: center;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                display: inline-block;
            }

            .text {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                display: inline-block;
            }

            .button {
                background-color: #636b6f;
                border: none;
                color: white;
                padding: 5px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 13px;
                cursor:pointer;
            }

            .rounded-button {border-radius: 12px;}

        </style>
    </head>
    <body>

        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    <a href="{{ url('/') }}">Home</a>

                    @auth
                        <a href="{{ url('/home') }}">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth

                    <a href="{{ url('/shoppingcart') }}">Shopping Cart</a>
                    <a href="{{ url('/favourites') }}">Favourites</a>
                    <a href="{{ url('/favourites') }}">Refresh</a>
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Your favourite products
                </div>

                <div class="text">
                    @foreach($produse as $key => $data)
                        <h3>{{$data->name}}</h3>
                        <form method="get">
                            <h3>Price: {{$data->pret}} <span>Quantity:
                                    <button type="submit" name="minus_quant" value="{{$data->idProdus}}" class="button rounded-button">-</button>
                                    {{$data->cantitateFav}}
                                    <button type="submit" name="plus_quant" value="{{$data->idProdus}}" class="button rounded-button">+</button>
                                </span>
                            </h3>
                        </form>
                        <span>{{$data->nameProducator}}</span>
                        <span>{{$data->address}}</span> </br>
                        <form method="get">
                            <button type="submit" name="remove_id" value="{{$data->idProdus}}" class="button rounded-button">Remove from favourites</button>
                            <button type="submit" name="add_sc_id" value="{{$data->idProdus}}" class="button rounded-button">Add to shopping cart</button>
                        </form>
                        </br> </br>
                    @endforeach
                </div>
            </div>
        </div>

        <?php

        if(isset($_GET['remove_id'])){
            $id_prod = $_GET['remove_id'];
            DB::table('favourites')->where('idProdusFav', '=', $id_prod)->delete();
        }

         if(isset($_GET['add_sc_id'])){
             $id_prod = $_GET['add_sc_id'];
             $check = DB::table('shoppingcart')->where('idProdusSC', '=', $id_prod)->exists();
             $cant = DB::table('favourites')->where('idProdusFav', '=', $id_prod)->value('cantitateFav');
             if(!$check) {
                 DB::table('shoppingcart')->insert([['idUser' => Auth::id(), 'idProdusSC' => $id_prod, 'cantitateSC' => $cant]]);
             }
             if($check) {
                 $cantitateNoua = DB::table('shoppingcart')->where('idProdusSC', '=', $id_prod)->value('cantitateSC');
                 $cantitateNoua += $cant;
                 DB::table('shoppingcart')->where('idProdusSC', '=', $id_prod)->update(['cantitateSC' => $cantitateNoua]);
             }
         }

         if(isset($_GET['minus_quant'])) {
             $id_prod = $_GET['minus_quant'];
             $cant = DB::table('favourites')->where('idProdusFav', '=', $id_prod)->value('cantitateFav');
             $cant -= 1;
             if($cant == 0) {
                 DB::table('favourites')->where('idProdusFav', '=', $id_prod)->delete();
             } else {
                 DB::table('favourites')->where('idProdusFav', '=', $id_prod)->update(['cantitateFav' => $cant]);
             }
         }

         if(isset($_GET['plus_quant'])) {
             $id_prod = $_GET['plus_quant'];
             $cant = DB::table('favourites')->where('idProdusFav', '=', $id_prod)->value('cantitateFav');
             $cant += 1;
             DB::table('favourites')->where('idProdusFav', '=', $id_prod)->update(['cantitateFav' => $cant]);
         }
         ?>

    </body>
</html>