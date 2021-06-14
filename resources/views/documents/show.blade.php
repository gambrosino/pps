@extends('layouts.app')

@section('content')

    <div class="container cards-container">
        <div class="card pb-6">
            <div class="card-header px-4">
                <h3 class="card-title">
                    {{ $document->title }}
                </h3>
            </div>
            <div class="card-body">
                <div class="flex">
                    <div>
                        <div>
                            Fecha de entrega: {{$document->created_at->format('d/m/Y')}}
                        </div>
                        @if($document->status != 'pending')
                            <div class="mt-3">
                                Fecha de corrección: {{ $document->updated_at->format('d/m/Y') }}
                            </div>
                            <div class="mt-3">
                                Devolución de tutor: {{ $document->message }}
                            </div>
                        @endif
                        <a class="mt-3 flex font-semibold text-blue-600" href="{{ asset("storage/documents/{$document->path}")}}" target="_blank">
                            <svg class="fill-current h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
                            Descargar
                        </a>
                    </div>
                    <div class="ml-auto py-2">
                        @include("pps.partials.{$document->status}")
                    </div>
                </div>
                @if ($document->revision->professionalPractice->status != 'completed')
                    @if ($document->status == 'pending' || auth()->user()->role->name == 'admin')
                        <form class="mt-4" method="POST" action="{{route('documents.update', ['document' => $document]) }}">
                            <div class="field-group">
                                <label for="status" class="field-label">Resultado</label>
                                <div class="w-full flex pt-2">
                                    <div class="flex items-center w-1/4">
                                        <span class="mr-1 text-xs">Aprobado</span>
                                        <input type="radio" id="status" name="status" value="accepted" checked>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="mr-1 text-xs">Reprobado</span>
                                        <input type="radio" id="status" name="status" value="rejected">
                                    </div>
                                </div>
                            </div>
                            <div class="field-group">
                                <label for="message" class="field-label">Mensaje</label>
                                <textarea id="message" type="text" name="message" value="{{ old('message') }}" class="field @error('message') is-invalid @enderror"></textarea>
                                @error('message')
                                    <span class="field-error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button class="button mt-4" type="submit">Guardar</button>
                            @method('PATCH')
                            @csrf
                        </form>
                    @endif
                @endif
            </div>
        </div>
    </div>

@endsection
