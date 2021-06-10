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
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form class="flex flex-col" method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="field-group">
                    <label for="email" class="field-label">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="field form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mt-4 flex justify-between items-baseline">
                    <button type="submit" class="button">
                        {{ __('Send Password Reset Link') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
