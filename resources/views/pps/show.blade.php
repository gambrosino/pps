@extends('layouts.app')
@section('backbutton')
    @if(auth()->user()->role->name <> 'student')
        @include('partials.back', ['route' => route('professional-practices.index').'?status='.$professionalPractice->status])
    @else
        @include('partials.back', ['route' => route('home')])
    @endif
@endsection
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
