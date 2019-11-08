@extends('layouts.app')

@section('content')

    <div class="container cards-container">
        <div class="card pb-6">
            <div class="card-header">
                <h3 class="card-title">
                    Revision
                </h3>
            </div>
            <div class="card-body">
                <div class="revision-list">
                    @foreach ($revision->documents as $document)
                        @if(auth()->user()->role->name == 'tutor')
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
                                    Fecha de entrega: {{$document->created_at->format('d/m/Y')}}
                                    <a class="mt-2 flex font-semibold text-blue-600" href="{{ asset("documents/{$document->path}")}}">
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
    </div>

@endsection
