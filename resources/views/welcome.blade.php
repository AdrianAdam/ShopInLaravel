<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Store</title>

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

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
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

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
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
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Shop by category
                </div>

                <div class="links">
                    <a href="{{ url('/samsung') }}">
                        <figure>
                            <img src="{{URL::asset('/img/pozaSamsung.jpg')}}" alt="Samsung" style="width:300px;height:300px;border:0;">
                            <figcaption>Samsung</figcaption>
                        </figure>
                    </a>
                    <a href="{{ url('/apple') }}">
                        <figure>
                            <img src="{{URL::asset('/img/pozaApple.jpg')}}" alt="Apple" style="width: 300px;height: 300px;border:0;">
                            <figcaption>Apple</figcaption>
                        </figure>
                    </a>
                    <a href="{{ url('/oneplus') }}">
                        <figure>
                            <img src="{{URL::asset('/img/pozaOneplus.jpg')}}" alt="OnePlus" style="width: 300px;height: 300px;border:0;">
                            <figcaption>OnePlus</figcaption>
                        </figure>
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>