@extends('layouts.main')
@section('title', 'Libros')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection
@section('content')
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
        <a class="btn btn-success" href={{ route('book.create') }}>
            <i class="fas fa-plus-circle fs-3"></i>
        </a>
    </div>

    <div class="cont-books">
        @foreach ($books as $book)
            <div class="card" style="width: 15rem;">
                <div class="cont-imagen">
                    <img src="{{ asset($book->image) }}" class="img-thumbnail" alt="...">
                    <div class="imagen-hover">
                        <button class="btn-edit-image" data-bs-toggle="modal"
                            data-bs-target="#editModalBook{{ $book->id }}"><i
                                class="icon fas fa-pencil-alt fs-4"></i></button>
                    </div>
                </div>
                <div>
                    <h5 class="text-center m-2">{{ $book->name }}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <a class="text-center fs-5"
                        href="{{ route('author.show', $book->author_id) }}">{{ $book->author_name . ' ' . $book->author_last_name }}</a>
                </ul>
                <div class="content-buttons card-body d-flex justify-content-between">
                    <a class="btn btn-primary" href="{{ route('book.show', $book->id) }}">
                        <i class="icon fas fa-eye fs-4"></i>
                    </a>
                    <a class="btn btn-warning" href="{{ route('book.edit', $book->id) }}">
                        <i class="icon fas fa-pencil-alt fs-4"></i>
                    </a>
                    <button button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#deleteBookModal{{ $book->id }}">
                        <i class="icon fas fa-trash fs-4"></i>
                    </button>
                </div>
            </div>
            @include('modals.delete-book')
            @include('modals.edit-image-book')
        @endforeach
    </div>
    {{ $books->links() }}

@endsection
@section('js')
    <script src="{{ asset('js/book/index.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
@endsection
