    <div class="card pb-6">
        <div class="card-header">
            <h3 class="card-title">
                Avances Pendientes
            </h3>
        </div>
        <div class="card-body">
            <div class="revision-list">
                @foreach ($professionalPractice->getPendingRevisions() as $revision)
                    <a href="{{ route('revisions.show', ['revision' => $revision]) }}" class="revision-item">
                        <div>
                            <h6 class="font-semibold">
                                Avance {{$revision->id}}
                            </h6>
                            <div>Fecha de entrega: {{$revision->created_at->format('d/m/Y')}}</div>
                        </div>
                        <div class="ml-auto py-2">
                            @include("pps.partials.{$revision->status}")
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

<div class="card pb-6">
    <div class="card-header">
        <h3 class="card-title">
            Avances Aceptados
        </h3>
    </div>
    <div class="card-body">
        <div class="revision-list">
            @foreach ($professionalPractice->getAcceptedRevisions() as $revision)
                <a href="{{ route('revisions.show', ['revision' => $revision]) }}" class="revision-item">
                    <div>
                        <h6 class="font-semibold">
                            Avance {{$revision->id}}
                        </h6>
                        <div>Fecha de entrega: {{$revision->created_at->format('d/m/Y')}}</div>
                    </div>
                    <div class="ml-auto py-2">
                        @include("pps.partials.{$revision->status}")
                    </div>
                </a>
            @endforeach
        </div>

    </div>
</div>