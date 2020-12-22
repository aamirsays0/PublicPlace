<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Public Place</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
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
                right: 950px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 44px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
                background-color: #f8f9fa!important;
                border-radius: .25rem!important;
                padding: 3rem!important;
                min-width: 768px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

            @if (Route::has('login'))
                <div class="top-right links">
                <img src="images/pp-icon.png" alt="logo" height="40" width="80"/>
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
             <div class="row">
             
                <div class="col-6"> <div class="title m-b-md">
                    Welcome to public place
                </div>

                <div class="links">
                    <a href="#">Links</a>
                    <a href="#">Links</a>
                    <a href="#">Links</a>
                    <a href="#">Links</a>
                    <a href="#">Links</a>
                    <a href="#">Links</a>
                  <!-- <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>-->
                </div></div>
                <div class="col-6">
                @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                       <h1 class="text-center">&#128156;</h1>
                       <h1> <a href="{{ route('login') }}">Login</a></h1>

                        @if (Route::has('register'))
                            <h1><a href="{{ route('register') }}">Register</a></h1>
                        @endif
                    @endauth
                
                </div>
            
              </div>
               
            </div>
        </div>
    </body>
</html>
