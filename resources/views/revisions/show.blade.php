@extends('layouts.app')
@section('backbutton')
    @include('partials.back', ['route' => route('professional-practices.show',$revision->professionalPractice)])
@endsection
@section('content')

    <div class="container cards-container">
        <div class="card pb-6">
            <div class="card-header px-4">
                <h3 class="card-title">
                    Avance {{$revision->number}}
                </h3>
            </div>
            <div class="card-body">
                <div class="mt-3">
                    <span class="badge badge-success">
                        {{ __('status.revision.'.$revision->status) }}
                    </span>
                </div>
                <div class="mt-3">
                    Descripción:
                    <span class="text-gray-700 uppercase font-semibold tracking-wide">
                        {{$revision->description}}
                    </span>
                </div>
                <div class="revision-list mt-5">
                    @foreach ($revision->documents as $document)
                        @if(auth()->user()->role->name != 'student')
                            <a href="{{ route('documents.show', ['document' => $document]) }}" class="revision-item">
                                <div>
                                    <h6 class="font-semibold mb-2">
                                        {{$document->title}}
                                    </h6>
                                    Fecha de entrega: {{$document->created_at->format('d/m/Y')}}
                                </div>
                                <div class="ml-auto py-2">
                                    @include("pps.partials.{$document->status}")
                                </div>
                            </a>
                        @else
                            <div class="revision-item">
                                <div>
                                    <h6 class="font-semibold mb-2">
                                        {{$document->title}}
                                    </h6>
                                    <div>Fecha de entrega: {{$document->created_at->format('d/m/Y')}}</div>
                                    @if ($document->status == 'rejected')
                                        <div class="badge badge-warning mt-2 mb-2">{{$document->message}}</div>
                                    @endif
                                    <a class="mt-2 flex font-semibold text-blue-600" href="{{ asset("storage/documents/{$document->path}")}}" target="_blank">
                                        <svg class="fill-current h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
                                        Descargar
                                    </a>
                                </div>
                                <div class="ml-auto py-2">
                                    @include("pps.partials.{$document->status}")
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        @if ($revision->status == 'rejected' && $revision->documents->last()->status <> 'pending' && auth()->user()->role->name == 'student')
            <div class="card pb-6">
                <div class="card-header">
                    <h3 class="card-title">
                        Actualizar Avance
                    </h3>
                </div>
                <div class="card-body">
                    <form class="flex flex-col" method="POST" action="{{ route('revisions.update',$revision) }}" enctype="multipart/form-data">
                        <div class="field-group">
                            <label for="title" class="field-label">{{ __('Titulo del Avance') }}</label>
                            <input id="title" type="text" name="title" value="{{ old('title') }}" autocomplete="title" class="field @error('title') is-invalid @enderror" >
                            @error('title')
                                <span class="field-error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="field-group">
                            <label for="document" class="field-label">{{ __('Adjuntar Avance') }}</label>
                            <input id="document" type="file" class=" @error('document') is-invalid @enderror" name="document" value="{{ old('document') }}" required >
                            @error('document')
                                <span class="field-error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="field-group">

                            <label for="hours" class="field-label">{{ __('Cantidad de Horas') }}</label>
                            <input id="hours" type="number" class=" @error('hours') is-invalid @enderror" name="hours" value="{{ old('hours') }}" required >
                            @error('hours')
                                <span class="field-error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mt-4 flex justify-between items-baseline">
                            <button type="submit" class="button">
                                {{ __('Crear Avance') }}
                            </button>
                        </div>
                        @method('PATCH')
                        @csrf
                    </form>
                </div>
            </div>
        @endif
    </div>

@endsection
