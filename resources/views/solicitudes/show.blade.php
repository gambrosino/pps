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
                    <span class="px-2 bg-orange-300 rounded-full shadow text-orange-600 uppercase tracking-wide font-semibold">
                        pendiente
                    </span>
                </div>
                <div class="mt-4">
                    Allumno:
                    <span class="text-gray-700 uppercase font-semibold tracking-wide">{{$solicitude->student->name}}</span>
                </div>
                <div class="mt-2">
                    Legajo:
                    <span class="text-gray-700">{{ $solicitude->student->fileNumber }}</span>
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
                    <a href="{{ asset($solicitude->path) }}" class="text-blue-600 font-bold flex">
                        <svg class="fill-current w-3 mr-2"xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
                        Descargar Solicitud
                    </a>
                </div>
                <div class="mt-8">
                    <a href="" class="button">Aceptar</a>
                </div>
            </div>

            </div>
        </div>

    </div>
</div>

@endsection
