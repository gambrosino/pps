<div class="card">
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

@include('home.partials.links', [
    'setting' => $setting
])

@foreach($user->solicitudes as $solicitude)

    @includeWhen(!is_null($solicitude->professionalPractice), 'pps.partials.card', [
        'professionalPractice' => $solicitude->professionalPractice
    ])
@endforeach

@if($user->solicitudes->count() == 0 ||
    (is_null($user->solicitudes->last()->professionalPractice)) )
<div class="card">
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
            @if ($solicitude->status == 'rejected')
                <div class="mt-2">
                    <span class="text-gray-700 uppercase font-semibold tracking-wide">Motivo de Rechazo:</span>
                    <p>
                        {{$solicitude->message}}
                    </p>
                </div>
            @endif
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
                   target="_blank" class="button" target="_blank">
                    Ver Solicitud
                </a>
            </div>
            <hr>
        @endforeach

        @if ($user->solicitudes->count() == 0 || $user->solicitudes->last()->status == 'rejected')
            <div class="mt-5 text-center">
                <a href="{{ route('solicitude.create') }}"
                   dusk="create-solicitude" class="button">Crear Nueva Solicitud</a>
            </div>
        @endif

    </div>
</div>
@endif
