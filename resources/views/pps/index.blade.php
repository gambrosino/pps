
@extends('layouts.app')

@section('content')

<div class="mx-auto container">

    @include('partials.back', ['route' => route('home')])

    <div class="w-full border-blue-400 border-t-8 rounded bg-white pb-3">
        <div>
            <h5 class="py-4 px-3 font-bold uppercase border-b border-gray-400">Practicas Profesionales Activas</h5>
        </div>

        @include('pps.partials.table')

    </div>

    <div class="w-full mt-10 border-blue-400 border-t-8 rounded bg-white pb-3">
        <div>
            <h5 class="py-4 px-3 font-bold uppercase border-b border-gray-400">Practicas Profesionales Pendientes de Aprobación</h5>
        </div>

        @include('pps.partials.table')

    </div>

</div>

@endsection
