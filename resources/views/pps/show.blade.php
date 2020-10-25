@extends('layouts.app')

@section('content')

    <div class="mx-auto container">

    </div>
    <div class="container cards-container mb-5">
        @include('pps.partials.card', compact('professionalPractice'))
    </div>
    <div class="container cards-container">
        @include('pps.partials.revision-list',compact('professionalPractice'))
    </div>

@endsection
