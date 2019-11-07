@extends('layouts.app')

@section('content')

    <div class="container cards-container">
        @component('pps.partials.card', compact('professionalPractice'))
        @endcomponent
    </div>

@endsection
