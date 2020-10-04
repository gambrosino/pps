<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            PPS
        </h3>
    </div>
    <div class="card-body">
        <div class="mt-2">
            <span class="badge badge-success">
                {{ __('status.pps.'.$professionalPractice->status) }}
            </span>
        </div>
        <div class="mt-4">
            Fecha de inicio:
            <span class="text-gray-700 uppercase font-semibold tracking-wide">
                {{$professionalPractice->created_at->format('d/m/Y')}}
            </span>
        </div>
        @if (auth()->user()->role->name != 'tutor')
            <div class="mt-2">
                Tutor:
                <span class="text-gray-700 uppercase font-semibold tracking-wide">
                    {{$professionalPractice->tutor->name}}
                </span>
            </div>
        @endif
        @if (auth()->user()->role->name != 'student')
            <div class="mt-2">
                Alumno:
                <span class="text-gray-700 uppercase font-semibold tracking-wide">
                    {{$professionalPractice->solicitude->student->name}}
                </span>
            </div>
        @endif
        <div class="mt-2">
            <span class="font-semibold">{{$professionalPractice->revisions->count()}}</span>
            avances registrados
        </div>
        <div class="mt-2">
            <span class="font-semibold">{{$professionalPractice->accepted_hours ?? 0}}</span>
            de 200 horas completadas
        </div>
        <div class="mt-2">
            <span class="font-semibold">{{$professionalPractice->reports->count()}}</span>
            informes finales registrados
        </div>
        @if (auth()->user()->role->name == 'student')
            <div class="mt-4">
                <a href="{{ route('professional-practices.show', ['professionalPractice' => $professionalPractice]) }}"
                class="text-blue-600 font-bold">Estado General de PPS</a>
            </div>
            @if ($professionalPractice->status == 'active')
                <div class="mt-4">
                    <a href="{{ route('revisions.create', ['professionalPractice' => $professionalPractice]) }}"
                    class="text-blue-600 font-bold">Añadir Avance</a>
                </div>
            @endif
            @if ($professionalPractice->status == 'hours_completed')
                <div class="mt-4">
                    <a href="{{ route('reports.create', ['professionalPractice' => $professionalPractice]) }}"
                    class="text-blue-600 font-bold">Añadir Informe Final</a>
                </div>
            @endif
        @endif
        <div class="mt-4">
            <a href="{{ route('solicitude.show', ['solicitude' => $professionalPractice->solicitude]) }}"
               class="text-blue-600 font-bold">Ver Solicitud de PPS</a>
        </div>
    </div>
</div>
