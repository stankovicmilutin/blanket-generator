<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
{{--    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">--}}
{{--    <link rel="icon" type="image/png" href="../assets/img/favicon.png">--}}
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport'/>

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
</head>

<body>
<div class="wrapper">
    @auth
        @include('layouts.partials.sidebar')
    @endauth
    <div
        @auth
            class="main-panel"
        @else
            class="full-page section-image" data-image="/img/full-screen-image-2.jpg" data-color="black"
        @endauth
    >

        @auth
            @include('layouts.partials.topbar')
        @endauth


        <div class="content" @guest style="padding-top: 5vh" @endguest>
            <div class="container-fluid">
                @include('flash::message')

                @yield('content')
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

@stack('js')
</body>
</html>
