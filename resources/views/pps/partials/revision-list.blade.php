<div class="card pb-6">
        <div class="card-header">
            <h3 class="card-title">
                Avances
            </h3>
        </div>
        <div class="card-body">
            <div class="revision-list">
                @foreach ($professionalPractice->revisions as $revision)
                    <div class="revision-item">
                        <div>
                            <h6 class="font-semibold">
                                Revision {{$loop->iteration}}
                            </h6>
                            Fecha de entrega: {{$revision->created_at->format('d/m/Y')}}
                        </div>
                        <div class="ml-auto py-2">
                            @include("pps.partials.{$revision->getOverallStatus()}")
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>