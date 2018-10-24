@foreach ($categoria as $cat)
    <div id="delete_categoria_{!! $cat->id !!}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Estas seguro?</h4>
                </div>
                <div class="modal-body">
                    <p>Está a punto de eliminar esta categoria. Este proceso no puede ser desecho</p>
                    <p>Está seguro que desea continuar?</p>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-success" href="{!! URL::route('categoria.destroy', array('categoria' => $cat->id)) !!}" data-token="{!! Session::getToken() !!}" data-method="DELETE">Yes</a>
                    <button class="btn btn-danger" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
