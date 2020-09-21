@extends('layouts.app')

@section('content')

    <div class="container cards-container">
        @include('partials.back', ['route' => route('home')])

        @component('solicitudes.partials.card', compact('solicitude'))

            @if(auth()->user()->role->name == 'admin' && !$solicitude->professionalPractice)
                <div class="mt-8">
                    <a href="{{ route('professional-practices.create', ['solicitude' => $solicitude]) }}"
                       class="button">Aceptar Solicitud</a>
                </div>
            @endif
        @endcomponent
    </div>

@endsection
