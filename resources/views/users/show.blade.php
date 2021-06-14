@extends('layouts.app')

@section('content')

    <div class="container cards-container">
        <div class="card pb-6">
            <div class="card-header px-4">
                <h3 class="card-title">
                    {{$user->name}}
                </h3>
            </div>
            <div class="card-body">
                <form class="mt-4" method="POST" action="{{route('users.update', ['user' => $user]) }}">
                    
                    <div class="field-group">
                        <label for="name" class="field-label">Nombre</label>
                        <input type="text" id="name" name="name" value="{{ $user->name }}" class="field @error('name') is-invalid @enderror" >
                            @error('name')
                                <span class="field-error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>

                    <div class="field-group">
                        <label for="file_number" class="field-label">Legajo</label>
                        <input id="file_number" type="text" name="file_number" value="{{ $user->file_number }}" class="field @error('file_number') is-invalid @enderror" readonly />
                        @error('file_number')
                            <span class="field-error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="field-group">
                        <label for="email" class="field-label">Email</label>
                        <input id="email" type="text" name="email" value="{{ $user->email }}" class="field @error('email') is-invalid @enderror"></input>
                        @error('email')
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
