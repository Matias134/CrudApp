@extends('layouts.main')

@section('title', 'Ver autor')

@section('content')
    <a class="position-absolute start-0 ps-3 fs-2" href={{ URL::previous() }}><i
            class="fas fa-arrow-left fs-2 back"></i></a>
    <h1 class="text-center">Autor</h1>
    <table class="table table-hover table-bordered fs-5">
        <tr>
            <th>Nombre</th>
            <td>{{ $author->name }}</td>
        </tr>
        <tr>
            <th>Apellido</th>
            <td>{{ $author->last_name }}</td>
        </tr>
        <tr>
            <th>Año de nacimiento</th>
            <td>{{ $author->year_of_birth }}</td>
        </tr>
        <tr>
            <th>Año de defunción</th>
            <td>{{ $author->year_of_death }}</td>
        </tr>
        <tr>
            <th>Edad</th>
            <td>{{ $author->age }}</td>
        </tr>
        <tr>
            <th>Nacionalidad</th>
            <td>{{ $author->nationality }}</td>
        </tr>
    </table>

@endsection
