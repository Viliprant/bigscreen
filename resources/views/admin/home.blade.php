@extends('layouts.admin')

@section('title')
BigScreen - Administration
@endsection

@push('head')
<!-- Scripts -->
<script>   
    let graphData = {!! json_encode($graphData) !!};
</script>
<script src="{{ asset('js/chart.js')}}">console.log('test')</script>
@endpush

@section('content')

    <main>
       <div class="graph"></div>
       <div class="graph"></div>
       <div class="graph"></div>
       <div class="graph"></div>
    </main>

@endsection

