@extends('layouts.app')

@section('content')

    <div class="container cards-container">

        @component('solicitudes.partials.card', compact('solicitude'))
        @endcomponent

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Crear Practica Profesional
                </h3>
            </div>

            <div class="card-body">
                <form class="flex flex-col" method="POST" action="{{ route('professional-practices.store') }}">
                    <div class="field-group">

                        <input id="solicitude_id" name="solicitude_id"
                               type="hidden" value="{{ $solicitude->id }}">


                        <label for="tutor_id" class="field-label">{{ __('Tutor') }}</label>
                        <select name="tutor_id" id="tutor_id"
                                class="@error('tutor_id') is-invalid @enderror"
                                required autocomplete="off">
                            <option value="null" selected disabled>Seleccione Tutor</option>
                            @foreach($tutors as $tutor)
                                <option value="{{$tutor->id}}">{{$tutor->name}}</option>
                            @endforeach
                        </select>

                        @error('tutor_id')
                        <span class="field-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mt-4 flex justify-between items-baseline">
                        <button type="submit" class="button">
                            {{ __('Asignar Tutor') }}
                        </button>
                    </div>
                    @csrf
                </form>

            </div>
        </div>

    </div>


@endsection
