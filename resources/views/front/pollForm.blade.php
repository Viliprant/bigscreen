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
            <p>Merci de répondre à toutes les questions et de valider le formulaire en bas de page.</p>
        </section>
        
        <section> <!-- FORM Prochainement ? -->
            @foreach($questions as $key => $question)
                <section>
                    <header>
                        <h1>{{"Question " . $key . "/" . count($questions)}}</h1>    
                    </header>    
                    <label for=""></label>
                    <input type="text" name="" id="">
                </section>
            @endforeach
        </section>
    </main>

@endsection

