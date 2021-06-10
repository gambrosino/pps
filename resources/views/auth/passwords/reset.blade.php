@extends('layouts.app')

@section('content')
<div class="container cards-container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                {{ __('Reset Password') }}
            </h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="field-group">
                    <label for="email" class="field-label">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="field form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="field-group">
                    <label for="password" class="field-label">{{ __('Password') }}</label>
                    <input id="password" type="password" class="field form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="field-group">
                    <label for="password-confirm" class="field-label">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="field form-control" name="password_confirmation" required autocomplete="new-password">
                </div>

                <div class="mt-4 flex justify-between items-baseline">
                    <button type="submit" class="button">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
