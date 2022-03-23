@extends('layouts.main')

@section('title', 'Autores')

@section('content')
    <h1 class="text-center">Autores</h1>
    @if (session('success'))
        <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session('failed'))
        <div id="fail-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('failed') }}
        </div>
    @endif
    <div class="cont-add">
        <a class="btn btn-success" href={{ route('author.create') }}>
            <i class="icon fas fa-plus-circle fs-3"></i>
        </a>
    </div>
    <table class="table table-hover table-bordered fs-5">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Año de nacimiento</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($authors as $author)
                <tr>
                    <td>{{ $author->name }}</td>
                    <td>{{ $author->last_name }}</td>
                    <td>{{ $author->year_of_birth }}</td>
                    <td class="content-buttons">
                        <a class="btn btn-primary" href={{ route('author.show', $author->id) }}>
                            <i class="icon fas fa-eye fs-4"></i>
                        </a>
                        <a class="btn btn-warning" href={{ route('author.edit', $author->id) }}>
                            <i class="icon fas fa-pencil-alt fs-4"></i>
                        </a>
                        <button button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $author->id }}">
                            <i class="icon fas fa-trash fs-4"></i>
                        </button>
                    </td>
                </tr>
                @include('modals.delete-author')
            @endforeach
        </tbody>
    </table>
    {{ $authors->links() }}

@endsection

@section('js')

    <script src="{{ asset('js/main.js') }}"></script>

@endsection
