@extends('layouts.app')
@section('backbutton')
    @if(auth()->user()->role->name == 'student')
        @include('partials.back', ['route' => route('home')])
    @else
        @include('partials.back', ['route' => route('solicitude.index').'?status='.$solicitude->status])
    @endif
@endsection
@section('content')

    <div class="container cards-container">

        @component('solicitudes.partials.card', compact('solicitude'))

            @if(auth()->user()->role->name == 'admin' && !$solicitude->professionalPractice && $solicitude->status != 'rejected')

                <form class="flex flex-col mt-5" method="POST" action="{{ route('solicitude.update',$solicitude) }}">
                    <div class="field-group">
                        <label for="message" class="field-label">{{ __('Motivo de rechazo') }}</label>
                        <textarea id="message" type="text" name="message" value="{{ old('message') }}" autocomplete="message" class="field @error('message') is-invalid @enderror" ></textarea>
                        @error('message')
                            <span class="field-error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mt-4 flex justify-around items-baseline">
                        <a href="{{ route('professional-practices.create', ['solicitude' => $solicitude]) }}"
                           class="button w-2/5 text-center">Aceptar</a>
                        <button type="submit" class="button w-2/5">
                            {{ __('Rechazar') }}
                        </button>
                    </div>
                    @method('PATCH')
                    @csrf
                </form>
            @endif
        @endcomponent
    </div>

@endsection
