<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Mayong</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class=" container " >
            <div class="mx-auto custom-position">
                @if (Route::has('login'))
                    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                        @auth
                        <h1 class="fw-bold mb-5">WELCOME TO MAYONG</h1>
                        <button class="btn btn-primary ps-3 pe-3 third-color"> <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 text-decoration-none text-white">Home</a> </button>
                        @else
                        <h1 class="fw-bold mb-5" >WELCOME TO MAYONG</h1>
                            <button class="btn btn-primary ps-4 pe-4 me-3 third-color"> <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 text-decoration-none text-white">Login </a></button>
                            @if (Route::has('register'))
                            <button class="btn btn-primary ps-3 pe-3 third-color"> <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 text-decoration-none text-white">Register</a></button>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>

    </body>
</html>
