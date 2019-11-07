@extends('layouts.app')

@section('content')
    <div class="container cards-container">

        @include("home.{$user->role->name}")

    </div>
@endsection
