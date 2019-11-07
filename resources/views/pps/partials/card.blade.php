<div class="card mx-10">
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
        <div class="mt-2">
            Tutor:
            <span class="text-gray-700 uppercase font-semibold tracking-wide">
                {{$professionalPractice->tutor->name}}
            </span>
        </div>
        <div class="mt-2">
            <span class="font-semibold">{{$professionalPractice->revisions->count()}}</span>
            revisiones
        </div>
        <div class="mt-2">
            <span class="font-semibold">120</span>
            de 200 horas completadas
        </div>

        <div class="mt-4">
            <a href="{{ route('solicitude.show', ['solicitude' => $professionalPractice->solicitude]) }}"
               class="text-blue-600 font-bold">Ver Solicitud</a>
        </div>
    </div>
</div>
