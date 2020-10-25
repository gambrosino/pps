@extends('layouts.app')

@section('content')

<div class="mx-auto container">

    @include('partials.back', ['route' => route('home')])

    <div class="w-full border-blue-400 border-t-8 rounded bg-white pb-3 mb-5">
        <div>
            <h5 class="py-4 px-3 font-bold uppercase border-b border-gray-400">Solicitudes Pendientes</h5>
        </div>

        @include('solicitudes.partials.table')

    </div>

    <div class="w-full border-blue-400 border-t-8 rounded bg-white pb-3 mb-5">
        <div>
            <h5 class="py-4 px-3 font-bold uppercase border-b border-gray-400">Solicitudes Aceptadas</h5>
        </div>

        @include('solicitudes.partials.table', ['solicitudes' => $acceptedSolicitudes])

    </div>

    <div class="w-full border-blue-400 border-t-8 rounded bg-white pb-3">
        <div>
            <h5 class="py-4 px-3 font-bold uppercase border-b border-gray-400">Solicitudes Rechazadas</h5>
        </div>

        @include('solicitudes.partials.table', ['solicitudes' => $rejectedSolicitudes])

    </div>

</div>

@endsection
