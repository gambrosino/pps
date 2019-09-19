@extends('layouts.app')

@section('content')
    <div class="container cards-container">
        @if (false)
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        pps
                    </h3>
                </div>
                <div class="card-body">
                    <div class="mt-2">
                <span class="px-2 bg-teal-300 rounded-full shadow text-teal-600 uppercase tracking-wide font-semibold">
                    active
                </span>
                    </div>
                    <div class="mt-4">
                        Tutor:
                        <span class="text-gray-700 uppercase font-semibold tracking-wide">John Doe</span>
                    </div>
                    <div class="mt-2">
                        <span class="font-semibold">3</span>
                        reviews
                    </div>
                    <div class="mt-2">
                        <span class="font-semibold">120</span>
                        of 200 hours completed
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        new review
                    </h3>
                </div>
                <div class="card-body">
                    <form action="">
                        <div class="field-group">
                            <label class="field-label"></label>
                            <input type="file" class="">
                        </div>
                        <div class="field-group">
                            <label class="field-label">Description</label>
                            <textarea type="text" class="field"></textarea>
                        </div>
                        <div class="mt-4">
                            <button class="button">save</button>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <div class="card">
                <div class="card-body">
                    <div class="mt-4">
                        <a href="{{ route('solicitude.create') }}" dusk="create-solicitude" class="button">Crear Nueva Solicitud</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
