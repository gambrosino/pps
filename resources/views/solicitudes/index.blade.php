@extends('layouts.app')
@section('backbutton')
    @include('partials.back', ['route' => route('home')])
@endsection
@section('content')

<div class="mx-auto container">

    <div class="w-full border-blue-400 border-t-8 rounded bg-white pb-3 mb-5">
        <div>
            <h5 class="py-4 px-3 font-bold uppercase border-b border-gray-400">Solicitudes {{$status['status']}}</h5>
        </div>

        @include('solicitudes.partials.table')

    </div>

</div>

@endsection
