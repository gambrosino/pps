<div class="card mx-10">
    <div class="card-header">
        <h3 class="card-title">
            Datos
        </h3>
    </div>
    <div class="card-body">
        <div class="mt-4">
            Nombre:
            <span class="text-gray-700 uppercase font-semibold tracking-wide">{{ $user->name }}</span>
        </div>
        <div class="mt-2">
            Email registrado:
            <span class="text-gray-700 font-semibold tracking-wide">{{ $user->email }}</span>
        </div>
        <div class="mt-2">
            Legajo:
            <span class="text-gray-700 font-semibold tracking-wide">{{ $user->file_number }}</span>
        </div>
    </div>
</div>

@foreach($user->solicitudes as $solicitude)
    @includeWhen(!is_null($solicitude->professionalPractice), 'pps.partials.card', [
        'professionalPractice' => $solicitude->professionalPractice
    ])
@endforeach

@if($user->solicitudes->count() == 0 ||
    ($user->solicitudes->count() == 1 && is_null($user->solicitudes->first()->professionalPractice)) )
<div class="card mx-10">
    <div class="card-header">
        <h3 class="card-title">
            Solicitud
        </h3>
    </div>

    <div class="card-body">
        @foreach($user->solicitudes as $solicitude)

            <div class="mt-4">
                <span class="badge badge-warning">
                    {{ __('status.solicitude.' . $solicitude->status) }}
                </span>
            </div>
            <div class="mt-2">
                <span class="text-gray-700 uppercase font-semibold tracking-wide">Descripcion:</span>
                <p>
                    {{$solicitude->description}}
                </p>
            </div>
            <div class="mt-2">
                <span class="text-gray-700 uppercase font-semibold tracking-wide">Fecha de solicitud:</span>
                {{$solicitude->created_at->format('d/m/Y')}}
            </div>
            <div class="mt-3 mb-3">
                <a href="{{ asset('storage/solicitude/'.$solicitude->path) }}"
                   target="_blank" class="text-blue-600 font-bold" target="_blank">
                    Ver Solicitud
                </a>
            </div>
            <hr>
        @endforeach

        @if ($user->solicitudes->count() == 0)
            <div class="mt-5">
                <a href="{{ route('solicitude.create') }}"
                   dusk="create-solicitude" class="button">Crear Nueva Solicitud</a>
            </div>
        @endif

    </div>
</div>
@endif
