@extends('layouts.main')

@section('title', 'Ver libro')

@section('content')
    <a class="position-absolute start-0 ps-3 fs-2" href={{ URL::previous() }}><i
            class="fas fa-arrow-left fs-2 back"></i></a>
    <h1 class="text-center">Libro</h1>
    <div class="cont-show-book">
        <div class="cont-show-image-book">
            <img src="{{ asset($book->image) }}" class="img-thumbnail" alt="">
        </div>
        <div class="cont-show-data-book">
            <div class="d-flex m-1 border">
                <div class="column fs-5 p-1">Nombre:</div>
                <div class="column-value fs-5 p-1">{{ $book->name }}</div>
            </div>
            <div class="d-flex m-1 border">
                <div class="column fs-5 p-1">Descripcion:</div>
                <div class="column-value fs-5 p-1">{{ $book->description }}</div>
            </div>
            <div class="d-flex m-1 border">
                <div class="column fs-5 p-1">Numero de paginas:</div>
                <div class="column-value fs-5 p-1">{{ $book->number_of_pages }}</div>
            </div>
            <div class="d-flex m-1 border">
                <div class="column fs-5 p-1">Año de publicación:</div>
                <div class="column-value fs-5 p-1">{{ $book->year_of_publication }}</div>
            </div>
            <div class="d-flex m-1 border">
                <div class="column fs-5 p-1">Autor asignado:</div>
                <div class="column-value fs-5 p-1">
                    <a class="text-center fs-5"
                        href="{{ route('author.show', $book->author_id) }}">{{ $book->author_name." ".$book->author_last_name }}</a>
                </div>
            </div>
        </div>
    </div>


@endsection
