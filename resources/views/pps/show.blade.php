@extends('layouts.app')

@section('content')

    <div class="container cards-container">
        @include('pps.partials.card', compact('professionalPractice'))

        @includeWhen(
            $professionalPractice->revisions->count() > 0,
            'pps.partials.revision-list',
            compact('professionalPractice')
        )
    </div>

@endsection
