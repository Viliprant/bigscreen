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
        
        <section id="form"> <!-- FORM Prochainement ? -->
            @foreach($questions as $key => $question)
                <section class="question">
                    <header>
                        <h1>{{"Question " . ($key+1) . "/" . count($questions)}}</h1>    
                    </header>    
                    <label for="{{$question['id']}}">{{$question['libelle']}}</label>
                    @switch($question['type'])
                        @case('A')
                            <div class="choix">
                                @foreach($question['answers'] as $keyAnswer => $answer)
                                    <div>
                                        <input type="radio" id="{{$keyAnswer . '-' . $question['id']}}" name="{{$question['id']}}" value="{{$answer['id']}}">
                                        <label for="{{$keyAnswer . '-' . $question['id']}}">{{$answer['libelle']}}</label>
                                    </div>
                                @endforeach
                            </div>
                            @break

                        @case('B')
                            <input type="text" id="{{$question['id']}}" name="{{$question['id']}}">
                            @break

                        @case('C')
                            <div class="choix">
                                <div>
                                    <input type="radio" id="1-{{$question['id']}}" name="{{$question['id']}}" value="1">
                                    <label for="1-{{$question['id']}}">1</label>
                                </div>
                                <div>
                                    <input type="radio" id="2-{{$question['id']}}" name="{{$question['id']}}" value="2">
                                    <label for="2-{{$question['id']}}">2</label>
                                </div>
                                <div>
                                    <input type="radio" id="3-{{$question['id']}}" name="{{$question['id']}}" value="3">
                                    <label for="3-{{$question['id']}}">3</label>
                                </div>
                                <div>
                                    <input type="radio" id="4-{{$question['id']}}" name="{{$question['id']}}" value="4">
                                    <label for="4-{{$question['id']}}">4</label>
                                </div>
                                <div>
                                    <input type="radio" id="5-{{$question['id']}}" name="{{$question['id']}}" value="5">
                                    <label for="5-{{$question['id']}}">5</label>
                                </div>
                            </div>
                            @break
                    @endswitch
                </section>
            @endforeach
            <div id="wrapper-submit">
                <input type="submit" value="Finaliser">
            </div>
        </section>
    </main>

@endsection

