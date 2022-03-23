<form action="{{ route('book.update_image', $book->id) }}" method="POST" enctype="multipart/form-data">
    @method('put')
    @csrf
    <div class="modal fade" id="editModalBook{{ $book->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar la imagen de {{ $book->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input class="form-control" type="file" required name="image" accept="image/*">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning">Editar</button>
                </div>
            </div>
        </div>
    </div>
</form>