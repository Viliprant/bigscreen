@extends('layouts.admin')

@section('title')
BigScreen - Administration
@endsection

@section('content')
{{-- <pre>
    {{var_dump($pollsData)}}
</pre> --}}
    <main>
        <div id="polls">
            @foreach ($pollsData as $poll)
                <table>
                    <thead>
                        <th>Q°</th>
                        <th>Question</th>
                        <th>Réponse</th>
                    </thead>
                    <tbody>
                        @foreach ($poll['answers'] as $answer)
                            <tr>
                                <td>{{$answer['nth']}}</td>
                                <td class="label">{{$answer['question']}}</td>
                                <td>{{$answer['libelle']}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach
        </div>
    </main>

@endsection