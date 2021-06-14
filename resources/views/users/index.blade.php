
@extends('layouts.app')
@section('backbutton')
    @include('partials.back', ['route' => route('home')])
@endsection
@section('content')
<div class="mx-auto container">
    <div class="w-full border-blue-400 mt-10 border-t-8 rounded bg-white">
        <div>
            <h5 class="py-4 px-3 inline-block font-bold uppercase border-b border-gray-400">Usuarios</h5>
            <a class="m-2 float-right inline-block button new-button" href="{{ route('users.create')}}">Nuevo Usuario</a>
        </div>
        @include('users.partials.table', $users )
    </div>
</div>

@endsection
