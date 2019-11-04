@extends('layouts.app')

@section('content')
    <div class="container cards-container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    {{ __('Login') }}
                </h3>
            </div>
            <div class="card-body">
                <form class="flex flex-col" method="POST" action="{{ route('login') }}">
                    <div class="field-group">
                        <label for="email" class="field-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required="" autocomplete="email" autofocus="" class="field @error('email') is-invalid @enderror">
                        @error('email')
                            <span class="field-error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="field-group">
                        <label for="password" class="field-label">{{ __('Password') }}</label>
                        <input id="password" type="password" class="field @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="field-error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mt-3 flex justify-start items-center">
                        <input class="mr-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="text-xs text-gray-700" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                    <div class="mt-4 flex justify-between items-baseline">
                        <button type="submit" class="button">
                            {{ __('Login') }}
                        </button>
                        @if (Route::has('password.request'))
                            <a class="text-xs text-gray-600 hover:text-gray-700" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                    @csrf
                </form>
            </div>
        </div>
    </div>
@endsection
