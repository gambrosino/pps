@extends('layouts.app')
@section('backbutton')
    @include('partials.back', ['route' => route('home')])
@endsection
@section('content')

    <div class="container cards-container">
        <div class="card w-1/2 pb-6">
            <div class="card-header px-4">
                <h3 class="card-title">
                    Configuraciones de Sistema
                </h3>
            </div>
            <div class="card-body">
                <form class="mt-4" method="POST" action="{{route('settings.update', ['setting' => $setting]) }}">
                    
                    <div class="field-group">
                        <label for="solicitude_link" class="field-label">Link PDF de Solicitud</label>
                        <input type="text" id="solicitude_link" name="solicitude_link" value="{{ $setting->solicitude_link }}" class="field @error('solicitude_link') is-invalid @enderror" >
                            @error('solicitude_link')
                                <span class="field-error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>

                    <div class="field-group">
                        <label for="revision_link" class="field-label">Link PDF de Avances</label>
                        <input id="revision_link" type="text" name="revision_link" value="{{ $setting->revision_link }}" class="field @error('revision_link') is-invalid @enderror" />
                        @error('revision_link')
                            <span class="field-error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="field-group">
                        <label for="report_link" class="field-label">Link PDF de Reporte Final</label>
                        <input id="report_link" type="text" name="report_link" value="{{ $setting->report_link }}" class="field @error('report_link') is-invalid @enderror"></input>
                        @error('report_link')
                            <span class="field-error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button class="button mt-4" type="submit">Guardar</button>

                    @method('PATCH')
                    @csrf
                </form>
            </div>
        </div>
    </div>

@endsection
