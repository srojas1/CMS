@foreach ($categoria as $nkey=>$cat)
    <div class="modal fade" id="modalEditarCategoria_{!! $cat->id !!}" tabindex="-1" role="dialog" aria-labelledby="modalEditarCategoria_{!! $cat->id !!}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <form id="edit_category_form_{!! $cat->id !!}" enctype="multipart/form-data" method="post">
                <div class="modal-content">
                    <!--- MODAL HEADER --->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div>
                            <h3 class="modal-title">Editar categoría: {{$cat->categoria}}</h3>
                        </div>
                    </div>
                    <div class="tab-content" id="agregarCategoriaTABcontent">
                        <div class="container-fluid">
                            <div class="form-group">
                                <input name="nombreCategoria" value="{{$cat->categoria}}" type="text" class="form-control" id="nombreCategoria" aria-describedby="nombreCategoriaHelp" placeholder="Nombre de categoría">
                            </div>
                            <div class="form-group d-flex justify-content-end pt-4 border-top">
                                <a tabindex="0" class="btn" role="button" data-toggle="tooltip" title="Eliminar">
                                    <i class="material-icons">delete</i>
                                </a>
                                <input type="hidden" name="id_categoria" class="id_categoria" value="{{$cat->id}}"/>
                                <a class="editar_categoria btn btn-primary" id="editarCategoria" data-toggle="tab" href="#editarCategoria" role="tab" aria-controls="editarCategoria" aria-selected="false">
                                    Guardar Cambios
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endforeach