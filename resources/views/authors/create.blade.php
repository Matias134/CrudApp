@extends('layouts.main')

@section('title', 'Crear autor')

@section('content')

    <a class="position-absolute start-0 ps-3 fs-2" href={{ route('author.index') }}><i class="fas fa-arrow-left fs-2 back"></i></a>
    <h1 class="text-center">Crear autor</h1>
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
        <form action={{ route('author.store') }} method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}">
                @error('name')
                    <div class="error fs-6">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Apellido</label>
                <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                    value="{{ old('last_name') }}">
                @error('last_name')
                    <div class="error fs-6">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Año de nacimiento</label>
                <input type="date" class="form-control @error('year_of_birth') is-invalid @enderror" name="year_of_birth"
                    value="{{ old('year_of_birth') }}">
                @error('year_of_birth')
                    <div class="error fs-6">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Año de defunción</label>
                <input type="date" class="form-control" name="year_of_death" value="{{ old('year_of_death') }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Nacionalidad</label>
                <select class="form-select @error('nationality') is-invalid @enderror" name="nationality"
                    id="select-nationality">
                    <option value="{{ old('nationality') }}">
                        @if (old('nationality'))
                            {{ old('nationality') }}
                        @else
                            Seleccione nacionalidad
                        @endif
                    </option>
                </select>
                @error('nationality')
                    <div class="error fs-6">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success fs-4">Crear autor</button>
        </form>
    </div>

@endsection

@section('js')

    <script src="{{ asset('js/nationalities.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    
@endsection
