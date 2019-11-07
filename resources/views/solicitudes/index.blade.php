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
                <tr>
                    <td class="px-3 py-3">Guido Amborisno</td>
                    <td class="px-3 py-3">38695</td>
                    <td class="px-3 py-3">05/11/2019</td>
                    <td class="px-3 py-3">
                        <button class="button">Ver</button>
                    </td>
                </tr>
                <tr class="bg-gray-100">
                    <td class="px-3 py-3">Federico Biondi</td>
                    <td class="px-3 py-3">37458</td>
                    <td class="px-3 py-3">06/11/2019</td>
                    <td class="px-3 py-3">
                        <button class="button">Ver</button>
                    </td>
                </tr>
                <tr>
                    <td class="px-3 py-3">Lucas Arregui</td>
                    <td class="px-3 py-3">37223</td>
                    <td class="px-3 py-3">09/11/2019</td>
                    <td class="px-3 py-3">
                        <button class="button">Ver</button>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
</div>

@endsection
