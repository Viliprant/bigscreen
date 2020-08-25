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
            <p id="intro">Merci de répondre à toutes les questions et de valider le formulaire en bas de page.</p>
        </section>
        
        <form id="form" action="{{route('add_poll')}}" method="post"> <!-- FORM Prochainement ? -->
            @csrf
            @foreach($questions as $key => $question)
                <section class="question">
                    <header>
                        <h1>{{"Question " . ($key+1) . "/" . count($questions)}}</h1>    
                    </header>
                    @switch($question['type'])
                        @case('A')
                            <p>{{$question['libelle']}}</p>
                            <div class="choix">
                                @foreach($question['answers'] as $keyAnswer => $answer)
                                    <div>
                                        <input type="radio" id="{{$keyAnswer . '-' . $question['id']}}" name="Q{{$key}}" value="{{$answer['id']}}">
                                        <label for="{{$keyAnswer . '-' . $question['id']}}">{{$answer['libelle']}}</label>
                                    </div>
                                @endforeach
                            </div>
                            @break

                        @case('B')
                            <label for="{{$question['id']}}">{{$question['libelle']}}</label>
                            <input type="text" id="{{$question['id']}}" name="Q{{$key}}">
                            @break

                        @case('C')
                            <p>{{$question['libelle']}}</p>
                            <div class="choix">
                                <div>
                                    <input type="radio" id="1-{{$question['id']}}" name="Q{{$key}}" value="1">
                                    <label for="1-{{$question['id']}}">1</label>
                                </div>
                                <div>
                                    <input type="radio" id="2-{{$question['id']}}" name="Q{{$key}}" value="2">
                                    <label for="2-{{$question['id']}}">2</label>
                                </div>
                                <div>
                                    <input type="radio" id="3-{{$question['id']}}" name="Q{{$key}}" value="3">
                                    <label for="3-{{$question['id']}}">3</label>
                                </div>
                                <div>
                                    <input type="radio" id="4-{{$question['id']}}" name="Q{{$key}}" value="4">
                                    <label for="4-{{$question['id']}}">4</label>
                                </div>
                                <div>
                                    <input type="radio" id="5-{{$question['id']}}" name="Q{{$key}}" value="5">
                                    <label for="5-{{$question['id']}}">5</label>
                                </div>
                            </div>
                            @break
                    @endswitch
                    {{-- DISPLAY ERROR --}}
                    @error("Q$key")
                    <div class="error">
                        @switch($message)
                            @case('validation.required')
                                <p>Le champ est requis</p>
                                @break

                            @case('validation.email')
                                <p>Email non valide</p>
                                @break

                            @default
                                <p>{{$message}}</p>
                        @endswitch
                    </div>
                    @enderror
                </section>
            @endforeach
            <div id="wrapper-submit">
                <input type="submit" value="Finaliser">
            </div>
        </section>
    </main>

@endsection

