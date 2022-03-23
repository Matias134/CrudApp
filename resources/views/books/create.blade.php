@extends('layouts.main')

@section('title', 'Crear libro')

@section('content')
    {{-- {{ $authors }} --}}
    <a class="position-absolute start-0 ps-3 fs-2" href={{ route('book.index') }}><i class="fas fa-arrow-left fs-2 back"></i></a>
    <h1 class="text-center">Crear libro</h1>
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
    <div class="fs-5">
        <form action={{ route('book.store') }} method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Titulo del libro</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}">
                @error('name')
                    <div class="error fs-6">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                    value="{{ old('description') }}"></textarea>
                @error('description')
                    <div class="error fs-6">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Imagen</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" accept="image/*">
                @error('image')
                    <div class="error fs-6">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Numero de páginas</label>
                <input type="number" class="form-control @error('number_of_pages') is-invalid @enderror" name="number_of_pages"
                    value="{{ old('number_of_pages') }}">
                @error('number_of_pages')
                    <div class="error fs-6">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Año de publicación</label>
                <input type="date" class="form-control @error('year_of_publication') is-invalid @enderror" name="year_of_publication" value="{{ old('year_of_publication') }}">
                @error('year_of_publication')
                    <div class="error fs-6">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Autor</label>
                <select class="form-select @error('author_id') is-invalid @enderror" name="author_id"id="select-nationality">
                    <option value="">Seleccione un autor</option>
                    @foreach ($authors as $author)
                        <option value="{{ $author->id }}">{{ $author->name." ".$author->last_name }}</option>
                    @endforeach
                </select>
                @error('author_id')
                    <div class="error fs-6">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success fs-4">Crear libro</button>
        </form>
    </div>

@endsection

@section('js')

    <script src="{{ asset('js/main.js') }}"></script>
    
@endsection
