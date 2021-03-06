@extends('layouts.app')

@section('content')
<div class="container cards-container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Registrarse
            </h3>
        </div>
        <div class="card-body">
            <form class="flex flex-col" method="POST" action="{{ route('register') }}">
                <div class="field-group">
                    <label for="name" class="field-label">Nombre</label>
                    <input id="name" type="text" class="field @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="field-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="field-group">
                    <label for="email" class="field-label">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required="" autocomplete="email" autofocus="" class="field @error('email') is-invalid @enderror">
                    @error('email')
                        <span class="field-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="field-group">
                    <label for="file_number" class="field-label">Legajo</label>
                    <input id="file_number" type="number" name="file_number" value="{{ old('file_number') }}" required autocomplete="file_number" autofocus="" class="field @error('file_number') is-invalid @enderror">
                    @error('file_number')
                        <span class="field-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="field-group">
                    <label for="password" class="field-label">Contraseña</label>
                    <input id="password" type="password" class="field @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="field-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="field-group">
                    <label for="password-confirm" class="field-label">Confirmar Contraseña</label>
                    <input id="password-confirm" type="password" class="field" name="password_confirmation" required autocomplete="new-password">
                </div>
                <div class="mt-4 flex justify-between items-baseline">
                    <button type="submit" class="button">
                        Registrar
                    </button>
                </div>
                @csrf
            </form>
        </div>
    </div>
</div>
@endsection
