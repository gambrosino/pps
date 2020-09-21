@extends('layouts.app')

@section('content')

    <div class="container cards-container">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Crear Revision
                </h3>
            </div>

            <div class="card-body">
                <form class="flex flex-col" method="POST" action="{{ route('revisions.store',$professionalPractice->id) }}">
                    <div class="field-group">

                        <label for="revision_attachments" class="field-label">{{ __('Adjuntar Revisión') }}</label>
                        <input id="revision_attachments" type="file" class=" @error('attachment') is-invalid @enderror" name="revision_attachments" value="{{ old('revision_attachments') }}" required >
                        @error('attachment')
                            <span class="field-error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="field-group">

                        <label for="description" class="field-label">{{ __('Descripción') }}</label>
                        <textarea id="description" type="text" name="description" value="{{ old('description') }}" autocomplete="description" class="field @error('description') is-invalid @enderror"></textarea>
                        @error('description')
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
                            {{ __('Crear Revisión') }}
                        </button>
                    </div>
                    @csrf
                </form>

            </div>
        </div>

    </div>


@endsection
