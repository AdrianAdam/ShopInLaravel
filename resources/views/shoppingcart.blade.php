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

            .title > form > button {
                width: 100px;
                height: 50px;
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

            .text{
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

            .textShoppingCart {
                width: 300px;
                display: inline-block;
            }

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
                    <a href="{{ url('/shoppingcart') }}">Refresh</a>
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Your shopping cart
                </div>

                <div class="text">
                    @foreach($produse as $key => $data)
                        <div class="textShoppingCart">
                            <h3>{{$data->name}}</h3>
                            <form method="get">
                                <h3>Price: {{$data->pret}} <span>Quantity:
                                        <input type="number" name="quantity" placeholder="{{$data->cantitateSC}}" style="width: 40px">
                                        <button type="submit" name="quantity_id" value="{{$data->idProdus}}" style="display: none"></button>
                                    </span>
                                </h3>
                            </form>
                            <h3>Final Price: {{$data->pret * $data->cantitateSC}}</h3>
                            <form method="get">
                                <button type="submit" name="remove_id" value="{{$data->idProdus}}" class="button rounded-button">Remove</button>
                            </form>
                            </br> </br>
                        </div>
                    @endforeach
                </div>

                <div class="title m-b-md">
                    <form method="get">
                        <button type="submit" name="buy_id" class="button rounded-button">Buy now</button>
                    </form>
                </div>
            </div>
        </div>

        <?php

        if(isset($_GET['remove_id'])){
            $id_prod = $_GET['remove_id'];
            DB::table('shoppingcart')->where('idProdusSC', '=', $id_prod)->delete();
        }

        if(isset($_GET['buy_id'])){
            $prod = DB::table('shoppingcart')->get();
            $id_order = DB::table('orders')->max('idOrder');
            $id_order += 1;

            foreach($prod as $key => $data) {
                DB::table('orders')->insert([['idOrder' => $id_order, 'idProdusOrder' => $data->idProdusSC, 'idUserOrder' => Auth::id(), 'cantitateOrder' => $data->cantitateSC]]);
                $cant = DB::table('shoppingcart')->where('idProdusSC', '=', $data->idProdusSC)->value('cantitateSC');
                $cantitateNoua = DB::table('produse')->where('idProdus', '=', $data->idProdusSC)->value('cantitate');
                $cantitateNoua -= $cant;
                DB::table('shoppingcart')->where('idProdusSC', '=', $data->idProdusSC)->delete();
                DB::table('produse')->where('idProdus', '=', $data->idProdusSC)->update(['cantitate' => $cantitateNoua]);
            }
        }

        if(isset($_GET['quantity'])) {
            $cantNoua = $_GET['quantity'];
            $id_prod = $_GET['quantity_id'];
            $cant = DB::table('produse')->where('idProdus', '=', $id_prod)->value('cantitate');
            if($cant >= $cantNoua) {
                DB::table('shoppingcart')->where('idProdusSC', '=', $id_prod)->update(['cantitateSC' => $cantNoua]);
            }
        }
        ?>

    </body>
</html>