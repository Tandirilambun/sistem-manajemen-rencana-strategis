@extends('main.index')
@section('index')
    <div class="container py-5">
        @if ($indikator_page === 'indikator_general')
            @include('Renstra.general-objective.indikator-general')
        @elseif ($indikator_page === 'indikator_ultimate')
            @include('Renstra.ultimate-objective.indikator-ultimate')
        @elseif ($indikator_page === 'indikator_intermediate')
            @include('Renstra.intermediate-objective.indikator-intermediate')
        @elseif ($indikator_page === 'indikator_outcome')
            @include('Renstra.outcome.indikator-outcome')
        @elseif($indikator_page === 'indikator_useofoutput')
            @include('Renstra.use-of-output.indikator-useofoutput')
        @elseif($indikator_page === 'indikator_output')
            @include('Renstra.output.indikator-output')
        @endif
    </div>
@endsection
