@foreach ($producto as $prod)
    <div id="detail_disableprod_{!! $prod->id !!}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">¿Estás seguro?</h4>
                </div>
                <div class="modal-body">
                    <p>Está a punto de cambiar la visibilidad de este producto. Este proceso no puede ser desecho</p>
                    <p>Está seguro que desea continuar?</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="hid_visibilidad" value="{{$prod->visibilidad}}"/>
                    <input type="hidden" id="id_producto" value="{{$prod->id}}"/>
                    <a class="btn btn-success" id="disable_product">Sí</a>
                    <button class="btn btn-danger" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
@endforeach