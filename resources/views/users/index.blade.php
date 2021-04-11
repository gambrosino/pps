
@extends('layouts.app')

@section('content')

<div class="mx-auto container">
    <div class="w-full border-blue-400 mt-10 border-t-8 rounded bg-white">
        <div>
            <h5 class="py-4 px-3 font-bold uppercase border-b border-gray-400">Usuarios</h5>
        </div>
        @include('users.partials.table', $users )
    </div>
</div>

@endsection
