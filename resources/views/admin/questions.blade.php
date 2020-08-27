@extends('layouts.admin')

@section('title')
BigScreen - Administration
@endsection

@section('content')

    <main>
        <div id="questions">
            <table>
                <thead>
                    <th>Numéro</th>
                    <th>Libellé</th>
                    <th>Type</th>
                </thead>
                <tbody>
                    @foreach ($questions as $question)
                        <tr>
                            <td>{{$question['nth']}}</td>
                            <td class="label">{{$question['libelle']}}</td>
                            <td>{{$question['type']}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

@endsection

