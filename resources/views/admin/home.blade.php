@extends('layouts.admin')

@section('title')
BigScreen - Administration
@endsection

@push('head')
<!-- Scripts -->
<script>   
    let graphData = {!! json_encode($graphData) !!};
</script>
<script src="{{ asset('js/chart.js')}}" defer></script>
@endpush

@section('content')
    <main>
        <div>
            <div class="graph">
                <canvas id="pie-6" ></canvas>
            </div>
            <div class="graph">
                <canvas id="pie-7"></canvas>
            </div>
            <div class="graph">
                <canvas id="pie-10"></canvas>
            </div>
            <div class="graph">
                <canvas id="radar"></canvas>
            </div>
        </div>
    </main>

@endsection

