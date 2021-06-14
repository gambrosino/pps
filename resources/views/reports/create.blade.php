@extends('layouts.app')
@section('backbutton')
    @include('partials.back', ['route' => route('professional-practices.show',$professionalPractice)])
@endsection
@section('content')

    <div class="container cards-container">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Crear Informe Final
                </h3>
            </div>

            <div class="card-body">
                <form class="flex flex-col" method="POST" action="{{ route('reports.store',$professionalPractice->id) }}" enctype="multipart/form-data">

                    <div class="field-group">
                        <label for="title" class="field-label">{{ __('Titulo del Reporte') }}</label>
                        <input id="title" type="text" name="title" value="{{ old('title') }}" autocomplete="title" class="field @error('title') is-invalid @enderror" >
                        @error('title')
                            <span class="field-error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="field-group">
                        <label for="document" class="field-label">{{ __('Adjuntar Reporte') }}</label>
                        <input id="document" type="file" class=" @error('document') is-invalid @enderror" name="document" value="{{ old('document') }}" required >
                        @error('document')
                            <span class="field-error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mt-4 flex justify-between items-baseline">
                        <button type="submit" class="button">
                            {{ __('Crear') }}
                        </button>
                    </div>
                    @csrf
                </form>
            </div>
        </div>
    </div>
@endsection
