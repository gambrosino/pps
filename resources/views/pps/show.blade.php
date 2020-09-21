@extends('layouts.app')

@section('content')

    <div class="mx-auto container">
        @include('partials.back', ['route' => route('home')])
    </div>
    <div class="container cards-container">
        @include('pps.partials.card', compact('professionalPractice'))
        @include('pps.partials.revision-list',compact('professionalPractice'))
    </div>

@endsection
