
@extends('layouts.app')

@section('content')

<div class="mx-auto container">

    @include('partials.back', ['route' => route('home')])

    @if ($professionalPracticesActives->count() >= 1)
        <div class="w-full border-blue-400 border-t-8 rounded bg-white pb-3">
            <div>
                <h5 class="py-4 px-3 font-bold uppercase border-b border-gray-400">Practicas Profesionales Activas</h5>
            </div>

            @include('pps.partials.table', ['professionalPractices' => $professionalPracticesActives ])

        </div>
    @endif

    @if ($professionalPracticesInRevision->count() >= 1)
        <div class="w-full border-blue-400 mt-10 border-t-8 rounded bg-white pb-3">
            <div>
                <h5 class="py-4 px-3 font-bold uppercase border-b border-gray-400">Practicas Profesionales En Revision</h5>
            </div>

            @include('pps.partials.table', ['professionalPractices' => $professionalPracticesInRevision ])

        </div>
    @endif

    @if ($professionalPracticesCompleted->count() >= 1)
        <div class="w-full border-blue-400 mt-10 border-t-8 rounded bg-white pb-3">
            <div>
                <h5 class="py-4 px-3 font-bold uppercase border-b border-gray-400">Practicas Profesionales Aprobadas</h5>
            </div>

            @include('pps.partials.table', ['professionalPractices' => $professionalPracticesCompleted ])

        </div>
    @endif

</div>

@endsection
