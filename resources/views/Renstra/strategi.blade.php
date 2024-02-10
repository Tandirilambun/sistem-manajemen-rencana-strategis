@extends('main.index')

@section('index')
    <div class="container py-3">
        @if ($status === 'status_general')
            @include('Renstra.general-objective.strategi-general')
        @elseif ($status === 'status_ultimate')
            @include('Renstra.ultimate-objective.strategi-ultimate')
        @elseif ($status === 'status_intermediate')
            @include('Renstra.intermediate-objective.strategi-intermediate')
        @elseif ($status === 'status_outcome')
            @include('Renstra.outcome.strategi-outcome')
        @elseif ($status === 'status_useofoutput')
            @include('Renstra.use-of-output.strategi-useofoutput')
        @elseif ($status === 'status_output')
            @include('Renstra.output.strategi-output')
        @endif
    </div>
@endsection
