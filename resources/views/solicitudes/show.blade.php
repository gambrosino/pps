@extends('layouts.app')

@section('content')

    <div class="mx-auto container">
        <div class="card-container">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Solicitud de PPS
                    </h3>
                </div>
                <div class="card-body">
                    <div class="mt-2">
                    <span
                        class="badge badge-warning">
                        pendiente
                    </span>
                    </div>
                    <div class="mt-4">
                        Alumno:
                        <span
                            class="text-gray-700 uppercase font-semibold tracking-wide">{{$solicitude->student->name}}</span>
                    </div>
                    <div class="mt-2">
                        Legajo:
                        <span class="text-gray-700">{{ $solicitude->student->file_number }}</span>
                    </div>
                    <div class="mt-2">
                        Fecha de entrega:
                        <span class="text-gray-700">{{ $solicitude->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="mt-2">
                        Descripción:
                        <div class="mt-2 px-2 py-3 border border-gray-200 bg-gray-100 rounded shadow-md">
                            <span class="text-gray-700 text-xs">{{ $solicitude->description }}</span>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{asset('storage/'.$solicitude->path)}}"
                           class="text-blue-600 font-bold">
                            Ver Solicitud
                        </a>
                    </div>
                    <div class="mt-8">
                        <a href="{{ route('professional-practices.create', ['solicitude' => $solicitude]) }}"
                           class="button">Aceptar Solicitud</a>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
