@extends('layouts.front')

@section('title')
BigScreen - Questionnaire
@endsection

@section('content')
    <header>
        <img src="{{asset('img/bigscreen_logo.png')}}" alt="logo bigscreen">
    </header>

    <main>
        <p> Toute l’équipe de Bigscreen vous remercie pour votre engagement. Grâce à
            votre investissement, nous vous préparons une application toujours plus
            facile à utiliser, seul ou en famille.
            Si vous désirez consulter vos réponse ultérieurement, vous pouvez consultez
            cette adresse: <a href="http://localhost:3000/poll/{{$poll_url}}">http://localhost:3000/poll/{{$poll_url}}</a>
        </p>
    </main>

@endsection

