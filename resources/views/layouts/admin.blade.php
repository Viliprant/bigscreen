<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="{{asset('css/admin.css')}}" rel="stylesheet">
    @stack('head')
</head>
<body>
    <div id="sidebar">
        <img src="{{asset('img/bigscreen_logo.png')}}" alt="logo bigscreen">
        <a href="{{route('admin')}}">Accueil</a>
        <a href="">Questionnaire</a>
        <a href="">Réponses</a>
        <div id="logout-wrapper">
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
    
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
    @yield('content')
</body>
</html>