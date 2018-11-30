<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Apple</title>

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

            .images > figure{
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
                        <a href="{{ url('/shoppingcart') }}">Shopping Cart</a>
                        <a href="{{ url('/favourites') }}">Favourites</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth

                    <a href="{{ url('/apple') }}">Refresh</a>
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Choose a product
                </div>

                <div class="images">
                    <figure>
                        <img src="{{URL::asset('/img/X.jpg')}}" alt="IphoneX" style="width:300px;height:300px;border:0;">
                        <figcaption>
                            <span>{{$produse[0]->name}}</span>
                        </figcaption>
                        <span>Price: {{$produse[0]->pret}}</span></br>
                        <span>In store: {{$produse[0]->cantitate}}</span></br>
                        @auth
                        <form method="get">
                            <button type="submit" name="submit_fav_id" value="{{$produse[0]->idProdus}}" class="button rounded-button">Add to favorites</button>
                            <button type="submit" name="submit_cart_id" value="{{$produse[0]->idProdus}}" class="button rounded-button">Add to cart</button>
                        </form>
                        @endauth
                    </figure>
                    <figure>
                        <img src="{{URL::asset('/img/XS.jpg')}}" alt="IphoneX" style="width:300px;height:300px;border:0;">
                        <figcaption>
                            <span>{{$produse[1]->name}}</span>
                        </figcaption>
                        <span>Price: {{$produse[1]->pret}}</span></br>
                        <span>In store: {{$produse[1]->cantitate}}</span></br>
                        @auth
                        <form method="get">
                            <button type="submit" name="submit_fav_id" value="{{$produse[1]->idProdus}}" class="button rounded-button">Add to favorites</button>
                            <button type="submit" name="submit_cart_id" value="{{$produse[1]->idProdus}}" class="button rounded-button">Add to cart</button>
                        </form>
                        @endauth
                    </figure>
                    <figure>
                        <img src="{{URL::asset('/img/XSMax.jpg')}}" alt="IphoneX" style="width:300px;height:300px;border:0;">
                        <figcaption>
                            <span>{{$produse[2]->name}}</span>
                        </figcaption>
                        <span>Price: {{$produse[2]->pret}}</span></br>
                        <span>In store: {{$produse[2]->cantitate}}</span></br>
                        @auth
                        <form method="get">
                            <button type="submit" name="submit_fav_id" value="{{$produse[2]->idProdus}}" class="button rounded-button">Add to favorites</button>
                            <button type="submit" name="submit_cart_id" value="{{$produse[2]->idProdus}}" class="button rounded-button">Add to cart</button>
                        </form>
                        @endauth
                    </figure>
                </div>
            </div>
        </div>

        <?php

        if(isset($_GET['submit_fav_id'])){
            $id_prod = $_GET['submit_fav_id'];
            $check = DB::table('favourites')->where('idProdusFav', '=', $id_prod)->exists();
            if(!$check) {
                DB::table('favourites')->insert([['idUser' => Auth::id(), 'idProdusFav' => $id_prod, 'cantitateFav' => 1]]);
            }
            if($check) {
                $cantitateNoua = DB::table('favourites')->where('idProdusFav', '=', $id_prod)->value('cantitateFav');
                $cantitateNoua += 1;
                DB::table('favourites')->where('idProdusFav', '=', $id_prod)->update(['cantitateFav' => $cantitateNoua]);
            }
        }

        if(isset($_GET['submit_cart_id'])){
            $id_prod = $_GET['submit_cart_id'];
            $check = DB::table('shoppingcart')->where('idProdusSC', '=', $id_prod)->exists();
            if(!$check) {
                DB::table('shoppingcart')->insert([['idUser' => Auth::id(), 'idProdusSC' => $id_prod, 'cantitateSC' => 1]]);
            }
            if($check) {
                $cantitateNoua = DB::table('shoppingcart')->where('idProdusSC', '=', $id_prod)->value('cantitateSC');
                $cantitateNoua += 1;
                DB::table('shoppingcart')->where('idProdusSC', '=', $id_prod)->update(['cantitateSC' => $cantitateNoua]);
            }
        }
        ?>

    </body>
</html>