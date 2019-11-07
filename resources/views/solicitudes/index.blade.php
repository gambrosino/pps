@extends('layouts.app')

@section('content')

<div class="mx-auto container">
    <div class="w-full border-blue-400 border-t-8 rounded  bg-white pb-3">
        <div>
            <h5 class="py-4 px-3 font-bold uppercase border-b border-gray-400">Solicitudes Pendientes</h5>
        </div>
        <table class=" w-full text-sm table-fixed ">
            <thead>
                <tr class="bg-gray-100">
                    <th class="text-left px-3 py-3 sm:w-auto md:w-2/3">Alumno</th>
                    <th class="text-left px-3 py-3">Legajo</th>
                    <th class="text-left px-3 py-3">Fecha</th>
                    <th class="text-left px-3 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($solicitudes as $s)
                    <tr>
                        <td class="px-3 py-3">{{ $s->student->name }}</td>
                        <td class="px-3 py-3">{{ $s->student->file_number }}</td>
                        <td class="px-3 py-3">{{ $s->created_at->format('d/m/Y') }}</td>
                        <td class="px-3 py-3">
                            <a href="{{ route('solicitude.show', ['solicitude' => $s]) }}" class="button">Ver</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection
