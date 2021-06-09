@extends('layouts.app')

@section('content')

    <div class="container cards-container">
        <div class="card pb-6">
            <div class="card-header">
                <h3 class="card-title">
                    Nuevo Usuario
                </h3>
            </div>
            <div class="card-body">
                <form class="mt-4" method="POST" action="{{ route('users.store') }}">
                    
                    <div class="field-group">
                        <label for="name" class="field-label">Nombre</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" class="field @error('name') is-invalid @enderror" >
                            @error('name')
                                <span class="field-error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>

                    <div class="field-group">
                        <label for="file_number" class="field-label">Legajo</label>
                        <input id="file_number" type="text" name="file_number" value="{{ old('file_number') }}" class="field @error('file_number') is-invalid @enderror"/>
                        @error('file_number')
                            <span class="field-error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="field-group">
                        <label for="email" class="field-label">Email</label>
                        <input id="email" type="text" name="email" value="{{ old('email') }}" class="field @error('email') is-invalid @enderror"></input>
                        @error('email')
                            <span class="field-error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="field-group">
                        <label class="field-label" for="is_tutor">
                            <input id="is_tutor" type="checkbox" name="is_tutor" class="mr-2" />
                            Es Tutor
                        </label>
                    </div>

                    <button class="button mt-4" type="submit">Guardar</button>
                    @csrf
                </form>
            </div>
        </div>
    </div>

@endsection
