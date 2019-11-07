@extends('layouts.app')

@section('content')

    <div class="container cards-container">
        @component('solicitudes.partials.card', compact('solicitude'))
            <div class="mt-8">
                <a href="{{ route('professional-practices.create', ['solicitude' => $solicitude]) }}"
                   class="button">Aceptar Solicitud</a>
            </div>
        @endcomponent
    </div>

@endsection
