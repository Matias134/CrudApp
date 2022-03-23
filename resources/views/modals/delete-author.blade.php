<form action="{{ route('author.destroy', $author->id) }}" method="POST">
    @method('delete')
    @csrf
    <div class="modal fade" id="deleteModal{{ $author->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">¿Estas seguro de eliminar el autor {{ $author->name }}?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¡Si eliminas un autor <b>se eliminaran todos sus libros asignados</b>!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
</form>
