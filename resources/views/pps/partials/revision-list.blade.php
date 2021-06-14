@if ($professionalPractice->status <> "completed")
    <div class="card pb-6">
        <div class="card-header justify-around">
            <h3 class="card-title">
                Avances Pendientes
            </h3>
            @if ($professionalPractice->getNonAcceptedRevisions()->count() != 0 && auth()->user()->role->name == 'student')
                    <a class="button" href="{{ route('revisions.create', ['professionalPractice' => $professionalPractice]) }}"
                    class="text-blue-600 font-bold">Nuevo</a>
            @endif
        </div>
        <div class="card-body">
            <div class="revision-list">
                @foreach ($professionalPractice->getNonAcceptedRevisions() as $revision)
                    <a href="{{ route('revisions.show', ['revision' => $revision]) }}" class="revision-item">
                        <div>
                            <h6 class="font-semibold">
                                Avance {{$revision->number}} entregado el {{$revision->created_at->format('d/m/Y')}}
                            </h6>
                            <div>Horas: {{$revision->documents->last()->hours}}</div>
                        </div>
                        <div class="ml-auto py-2">
                            @include("pps.partials.{$revision->status}")
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endif

@if ($professionalPractice->getAcceptedRevisions()->count() != 0)
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
                                Avance {{$revision->number}} entregado el {{$revision->created_at->format('d/m/Y')}}
                            </h6>
                            <div>Horas: {{$revision->documents->last()->hours}}</div>
                        </div>
                        <div class="ml-auto py-2">
                            @include("pps.partials.{$revision->status}")
                        </div>
                    </a>
                @endforeach
            </div>

        </div>
    </div>
@endif

@if ($professionalPractice->status != "active")
    <div class="card pb-6">
        <div class="card-header justify-around">
            <h3 class="card-title">
                Informe Final
            </h3>
            @if(auth()->user()->role->name == 'student')
                @if ($professionalPractice->canAddNewReport())
                    <a class="button" href="{{ route('reports.create', ['professionalPractice' => $professionalPractice]) }}">Nuevo</a>
                @endif
            @endif
        </div>
        <div class="card-body">
            <div class="revision-list">
                @foreach ($professionalPractice->reports as $report)
                    @if(auth()->user()->role->name != 'student')
                        <a href="{{ route('reports.show', ['report' => $report]) }}" class="revision-item">
                            <div>
                                <h6 class="font-semibold">
                                    {{$report->title}}
                                </h6>
                                <div>Fecha de entrega: {{$report->created_at->format('d/m/Y')}}</div>
                            </div>
                            <div class="ml-auto py-2">
                                @include("pps.partials.{$report->status}")
                            </div>
                        </a>
                    @else
                        <div class="revision-item">
                            <div>
                                <h6 class="font-semibold mb-2">
                                    {{$report->title}}
                                </h6>
                                <div>Fecha de entrega: {{$report->created_at->format('d/m/Y')}}</div>
                                @if ($report->status == 'rejected')
                                    <div class="badge badge-warning mt-2 mb-2">{{$report->message}}</div>
                                @endif
                                <a class="mt-2 flex font-semibold text-blue-600" href="{{ asset("storage/documents/{$report->path}")}}" target="_blank">
                                    <svg class="fill-current h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
                                    Descargar
                                </a>
                            </div>
                            <div class="ml-auto py-2">
                                @include("pps.partials.{$report->status}")
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endif

@if ($professionalPractice->status == "completed")
    <div class="card pb-6">
        <div class="card-header">
            <h3 class="card-title">
                Acta de Examen
            </h3>
        </div>
        <div class="card-body">
            <div class="revision-list">
                <div class="revision-item">
                    <div>
                        <h6 class="font-semibold mb-2">
                            Alumno: {{$professionalPractice->solicitude->student->name}}
                        </h6>
                        <div>Acta: {{$professionalPractice->certificates->first()->number}}</div>
                        <div>Folio: {{$professionalPractice->certificates->first()->folio}}</div>
                        <div>Nota: {{$professionalPractice->certificates->first()->note}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif