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

            <section class="question">
                <header>
                    <h1>{{"Question 1/" . (count($questions) + 1)}}</h1>
                </header>
                <label for="email">Votre adresse mail</label>
                <input type="text" id="email" name="email" value="{{ old('email') }}">
                {{-- DISPLAY ERROR --}}
                @error("email")
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

            @foreach($questions as $key => $question)
                <section class="question">
                    <header>
                        <h1>{{"Question " . ($key + 2) . "/" . (count($questions) + 1)}}</h1>    
                    </header>
                    @switch($question['type'])
                        @case('A')
                            <p>{{$question['libelle']}}</p>
                            <div class="choix">
                                @foreach($question['choices'] as $keyChoice => $choice)
                                    <div>
                                        <input type="radio" id="{{$keyChoice . '-' . $question['id']}}" name="Q{{ ($key + 1) }}" value="{{$choice}}" {{ old( "Q".($key + 1) ) == $choice ? 'checked' : '' }}>
                                        <label for="{{$keyChoice . '-' . $question['id']}}">{{$choice}}</label>
                                    </div>
                                @endforeach
                            </div>
                            @break

                        @case('B')
                            <label for="{{$question['id']}}">{{$question['libelle']}}</label>
                            <input type="text" id="{{$question['id']}}" name="Q{{ ($key + 1) }}" value="{{old( "Q".($key + 1) )}}">
                            @break

                        @case('C')
                            <p>{{$question['libelle']}}</p>
                            <div class="choix">
                                <div>
                                    <input type="radio" id="1-{{$question['id']}}" name="Q{{ ($key + 1) }}" value="1" {{ old( "Q".($key + 1) ) == 1 ? 'checked' : '' }}>
                                    <label for="1-{{$question['id']}}">1</label>
                                </div>
                                <div>
                                    <input type="radio" id="2-{{$question['id']}}" name="Q{{ ($key + 1) }}" value="2" {{ old( "Q".($key + 1) ) == 2 ? 'checked' : '' }}>
                                    <label for="2-{{$question['id']}}">2</label>
                                </div>
                                <div>
                                    <input type="radio" id="3-{{$question['id']}}" name="Q{{ ($key + 1) }}" value="3" {{ old( "Q".($key + 1) ) == 3 ? 'checked' : '' }}>
                                    <label for="3-{{$question['id']}}">3</label>
                                </div>
                                <div>
                                    <input type="radio" id="4-{{$question['id']}}" name="Q{{ ($key + 1) }}" value="4" {{ old( "Q".($key + 1) ) == 4 ? 'checked' : '' }}>
                                    <label for="4-{{$question['id']}}">4</label>
                                </div>
                                <div>
                                    <input type="radio" id="5-{{$question['id']}}" name="Q{{ ($key + 1) }}" value="5" {{ old( "Q".($key + 1) ) == 5 ? 'checked' : '' }}>
                                    <label for="5-{{$question['id']}}">5</label>
                                </div>
                            </div>
                            @break
                    @endswitch
                    {{-- DISPLAY ERROR --}}
                    @error("Q".($key + 1))
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

