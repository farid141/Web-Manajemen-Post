@extends('layouts.main')
@section('container')
    <h1>Halaman {{ $title }}</h1>
    <h3>{{ $name }}</h3>
    <p>{{ $email }}</p>
    <img src="img/{{ $image }}" alt="Farid Nubaili" class="img-thumbnail rounded-circle" width="200">
@endsection