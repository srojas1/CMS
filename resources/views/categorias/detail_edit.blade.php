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
                            <div class="d-flex align-items-center row ml-1">
                                Imagen principal
                                <span class="help pl-3">
													<a tabindex="0" class="btn badge badge-pill badge-secondary badge-light" role="button" data-toggle="tooltip" title="Agrega una imagen de 120px x 120px">
														<i class="material-icons">help</i>
													</a>
												</span>
                            </div>
                            <div class="imagen-medidas row col-12">
                                <small>.jpg .png | 350px x 140px</small>
                            </div>
                            <div class="d-flex pt-4">
                                <div class="agregar-imagen-featured form-group">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="imagen_principal" class="main_image custom-file-input justify-content-center" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
                                            <label class="custom-file-label justify-content-center" for="inputGroupFile04">
                                                <i class="material-icons">add_photo_alternate</i>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="form-group">
                                    <div class="inline-block position-relative">
                                        @if($cat->imagen_principal)
                                            <img src="{{ asset('images/'.getJsonValue($cat->imagen_principal))}}" class="imagen-featured shadow-sm border-top border-bottom border-right border-left">
                                        @else
                                            <img src="{{ asset('images/producto-icon.jpg') }}" class="imagen-featured shadow-sm border-top border-bottom border-right border-left">
                                        @endif
                                        <a href="#" class="badge badge-light badge-pill eliminarImagen shadow-sm">
                                            <i class="material-icons">clear</i>
                                        </a>
                                    </div>
                                </div>
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