@extends('layouts.app')
@section('backbutton')
    @include('partials.back', ['route' => route('professional-practices.show',$professionalPractice)])
@endsection
@section('content')

    <div class="container cards-container">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Guardar Acta de la PPS
                </h3>
            </div>

            <div class="card-body">
                <form class="flex flex-col" method="POST" action="{{ route('certificate.store',$professionalPractice->id) }}">

                    <div class="field-group">
                        <label for="number" class="field-label">{{ __('Acta N°') }}</label>
                        <input id="number" type="text" name="number" value="{{ old('number') }}" autocomplete="number" class="field @error('number') is-invalid @enderror" >
                        @error('number')
                            <span class="field-error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="field-group">
                        <label for="folio" class="field-label">{{ __('Folio') }}</label>
                        <input id="folio" type="text" name="folio" value="{{ old('folio') }}" autocomplete="folio" class="field @error('folio') is-invalid @enderror" >
                        @error('folio')
                            <span class="field-error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="field-group">
                        <label for="note" class="field-label">{{ __('Nota') }}</label>
                        <input id="note" type="text" name="note" value="{{ old('note') }}" autocomplete="note" class="field @error('note') is-invalid @enderror" >
                        @error('note')
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