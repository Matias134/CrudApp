<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand fs-4" href={{ route('book.index') }}>Crud app</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav fs-5">
                <li class="nav-item">
                    <a class="nav-link" href={{ route('book.index') }}>Libros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href={{ route('author.index') }}>Autores</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
