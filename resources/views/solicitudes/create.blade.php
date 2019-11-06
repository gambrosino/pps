@extends('layouts.app')

@section('content')

<div class="container cards-container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                {{ __('Register') }}
            </h3>
        </div>
        <div class="card-body">
            <form class="flex flex-col" method="POST" action="{{ route('solicitude.store') }}" enctype="multipart/form-data">
                <div class="field-group">
                    <label for="attachment" class="field-label">{{ __('Adjuntar Formulario') }}</label>
                    <input id="attachment" type="file" class=" @error('attachment') is-invalid @enderror" name="attachment" value="{{ old('attachment') }}" required >
                    @error('attachment')
                        <span class="field-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="field-group">
                    <label for="description" class="field-label">{{ __('Descrición') }}</label>
                    <textarea id="description" type="text" name="description" value="{{ old('description') }}" autocomplete="description" class="field @error('description') is-invalid @enderror"></textarea>
                    @error('description')
                        <span class="field-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mt-4">
                    <button type="submit" class="button">
                        {{ __('Guardar') }}
                    </button>
                </div>
                @csrf
            </form>
        </div>
    </div>
</div>

@endsection
