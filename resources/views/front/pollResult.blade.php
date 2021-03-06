@extends('layouts.front')

@section('title')
BigScreen - Questionnaire
@endsection

@section('content')
    <header>
        <img src="{{asset('img/bigscreen_logo.png')}}" alt="logo bigscreen">
    </header>

    <main>
        <section>
            <p id="intro">Vous trouverez ci-dessous les réponses que vous avez apportées à notre sondage le <span class="bold">{{ $poll['created_at']->format('j/n/Y à H:i:s') }}</span>.</p>
        </section>
        
        <section id="form">
            <section class="question">
                <header>
                    <h1>{{"Question 1/" . (count($poll['answers'])+1)}}</h1>    
                </header>    
                <p class="text-less">Votre adresse mail</p>
                <p class="response">{{$poll['email']}}</p>
                
            </section>
            @foreach ($poll['answers'] as $key => $answer)
            <section class="question">
                <header>
                    <h1>{{"Question " . ($key+2) . "/" . (count($poll['answers'])+1)}}</h1>    
                </header>    
                <p class="text-less">{{$answer['question']['libelle']}}</p>
                <p class="response">{{$answer['libelle']}}</p>
                
            </section>
            @endforeach
            
        </section>
    </main>

@endsection

