<div class="modal fade" id="modalAgregarProducto" tabindex="-1" role="dialog" aria-labelledby="modalAgregarProducto" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<form id="create_product_form" enctype="multipart/form-data" method="post">
			<div class="modal-content">
				<!--- MODAL HEADER --->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<div>
						<h3 class="modal-title">Agregar producto</h3>
					</div>
				</div>
				<div class="modal-body">
					<div class="board-tabs">
						<ul class="nav nav-tabs" id="agregarProductoTAB" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="editarProductoDescripcion-tab" data-toggle="tab" href="#editarProductoDescripcion" role="tab" aria-controls="editarProductoDescripcion" aria-selected="true">1. Descripción</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="editarProductoImagenes-tab" data-toggle="tab" href="#editarProductoImagenes" role="tab" aria-controls="editarProductoImagenes" aria-selected="false">2. Imágenes</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="editarProductoInventario-tab" data-toggle="tab" href="#editarProductoInventario" role="tab" aria-controls="editarProductoInventario" aria-selected="false">3. Inventario</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="editarProductoAtributos-tab" data-toggle="tab" href="#editarProductoAtributos" role="tab" aria-controls="editarProductoAtributos" aria-selected="false">4. Atributos</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="editarProductoVinculacion-tab" data-toggle="tab" href="#editarProductoVinculacion" role="tab" aria-controls="editarProductoVinculacion" aria-selected="false">5. Vinculación</a>
							</li>
						</ul>
					</div>
					<div class="tab-content" id="agregarProdcutoTABcontent">
						<div class="tab-pane fade show active" id="editarProductoDescripcion" role="tabpanel" aria-labelledby="editarProductoDescripcion-tab">
							<div class="board-body">
								<h4>Descripción del producto</h4>
								<div class="container-fluid">
									<div class="form-group">
										<input name="nombreProducto" type="text" class="form-control" id="nombreProducto" aria-describedby="nombreProductoHelp" placeholder="Nombre de producto">
									</div>
									<div class="form-group">
										<input name="codigoProducto" type="text" class="form-control" id="codigoProducto" aria-describedby="codigoProductoHelp" placeholder="Código de producto">
									</div>
									<div class="form-group">
										<textarea name="descripcionProducto" class="form-control" id="descripcionProducto" rows="3" aria-describedby="descripcionProductoHelp" placeholder="Añade una pequeña descripción"></textarea>
									</div>
									<div class="form-group">
										<h4>
											Categoría del producto
										</h4>
										<div class="form-group">
											<select name="selectCategorias" class="custom-select" id="categoriaProducto" rows="3">
												@if($categoria)
													@foreach($categoria as $key => $cats)
														@if ($cats->id)
															<option value={{$cats->id}} selected>{{$cats->categoria}}</option>
														@else
															<option value="{{$cats->id}}">{{$cats->categoria}}</option>
														@endif
													@endforeach
												@else
													No se encontraron resultados
												@endif
											</select>
											<div class="col-12 d-inline-flex justify-content-start pt-4 pb-2">
												<a href="#" data-toggle="collapse" data-target="#collapseCrearCategoria" aria-expanded="false" aria-controls="collapseCrearCategoria">Crear una nueva categoría</a>
											</div>
											<div class="collapse" id="collapseCrearCategoria">
												<div class="crear-categoria container-fluid row justify-content-start align-items-center pt-2 pl-3 mr-0 ml-0">
													<div class="col-12 col-sm-12 col-md-7 col-lg-5 d-flex pl-0">
														<div class="form-group">
															<div class="input-group">
																<div class="custom-file">
																	<input type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
																	<label class="custom-file-label" for="inputGroupFile04"><i class="material-icons">add_photo_alternate</i></label>
																</div>
															</div>
														</div>
														<div class="form-group">
															<input  id="nueva_categoria_inside" type="text" class="form-control nombre-nueva-categoria nueva_categoria_inside" placeholder="Nombre de categoría">
														</div>
													</div>
													<div class="col-12 col-sm-12 col-md-5 col-lg-7 d-flex pl-0">
														<div class="form-group">
															<button type="button" class="crear_categoria_inside btn btn-primary">Crear categoría</button>
														</div>
														<div class="form-group">
															<small class="help">
																<a tabindex="0" class="btn badge badge-pill badge-secondary badge-light" role="button" data-toggle="tooltip" title="Agrega una imagen (jpp) de 120px x 120px">
																	<i class="material-icons">help</i>
																</a>
															</small>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="form-group d-flex justify-content-end pt-4 border-top">
										<a tabindex="0" class="btn" role="button" data-toggle="tooltip" title="Eliminar">
											<i class="material-icons">delete</i>
										</a>
										<a class="crear_producto btn btn-primary" id="agregarProductoImagenes-tab" data-toggle="tab" href="#agregarProductoImagenes" role="tab" aria-controls="agregarProductoImagenes" aria-selected="false">
											Agregar producto
										</a>
									</div>
								</div>
							</div>
						</div>

						<div class="tab-pane fade show" id="editarProductoImagenes" role="tabpanel" aria-labelledby="editarProductoImagenes-tab">
							<div class="board-body">
								<h4>Imágenes del producto</h4>
								<div class="d-flex">
									<div class="col-12 col-sm-6 col-md-6 col-lg-4">
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
														<input type="file" name="filename_main" class="main_image custom-file-input justify-content-center" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
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
													<img class="imagen-featured shadow-sm border-top border-bottom border-right border-left">
													<a href="#" class="badge badge-light badge-pill eliminarImagen shadow-sm">
														<i class="material-icons">clear</i>
													</a>
												</div>
											</div>
										</div>
									</div>
									<div class="col-12 col-sm-6 col-md-6 col-lg-8">
										<div class="d-flex align-items-center row ml-1">
											{{--Galería de producto--}}
											{{--<span class="help pl-3">--}}
													{{--<a tabindex="0" class="btn badge badge-pill badge-secondary badge-light" role="button" data-toggle="tooltip" title="Agrega una imagen 600px x 600px">--}}
														{{--<i class="material-icons">help</i>--}}
													{{--</a>--}}
												{{--</span>--}}
											{{--<div class="imagen-medidas row col-12">--}}
												{{--<small>.jpg .png | 350px x 140px</small>--}}
											</div>
										</div>
										<div class="d-flex pt-4 row ml-1">
											{{--<div class="agregar-imagen-galeria form-group mr-2">--}}
												{{--<div class="input-group">--}}
													{{--<div class="custom-file">--}}
														{{--<input type="file" name="filename[]" multiple="multiple" class="gallery_image custom-file-input justify-content-center" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">--}}
														{{--<label class="custom-file-label justify-content-center" for="inputGroupFile04">--}}
															{{--<i class="material-icons">add_photo_alternate</i>--}}
														{{--</label>--}}
													{{--</div>--}}
												{{--</div>--}}
											{{--</div>--}}

											{{--<div class="d-flex mr-2">--}}
												{{--<div class="form-group">--}}
													{{--<div class="contenedor_galeria inline-block position-relative">--}}
													{{--</div>--}}
												{{--</div>--}}
											{{--</div>--}}
										</div>
									</div>
								</div>
								<div class="form-group d-flex justify-content-end pt-4 border-top">
									<a tabindex="0" class="btn" role="button" data-toggle="tooltip" title="Eliminar">
										<i class="material-icons">delete</i>
									</a>
									<a class="crear_producto btn btn-primary" id="agregarProductoImagenes-tab" data-toggle="tab" href="#agregarProductoImagenes" role="tab" aria-controls="agregarProductoImagenes" aria-selected="false">
										Agregar producto
									</a>
								</div>
							</div>

						<div class="tab-pane fade show" id="editarProductoInventario" role="tabpanel" aria-labelledby="editarProductoInventario-tab">
							<div class="board-body">
								<h4>Inventario del producto</h4>
								<div class="container-fluid row align-items-center justify-content-start">
									<div class="d-flex col-12 col-sm-12 col-md-12 col-lg-6">
										@if (count($stock) > 0)
											@foreach($stock as $nkey=>$st)
												<div class="form-group custom-control custom-radio custom-control-inline">
													@if($nkey== 0)
														<input name="stockValue_add" type="radio" id="customRadioInline_add_{{$nkey+1}}" class="customRadioInline custom-control-input" value="{{$st['value']}}" checked>
														@else
														<input name="stockValue_add" type="radio" id="customRadioInline_add_{{$nkey+1}}" class="customRadioInline custom-control-input" value="{{$st['value']}}">
													@endif

													<label class="custom-control-label" for="customRadioInline_add_{{$nkey+1}}">{{$st['nombre']}}</label>
												</div>
											@endforeach
										@endif
									</div>

									<div class="d-flex col-12 col-sm-12 col-md-12 col-lg-6">
										<div class="form-group col-10 col-md-9 pl-0">
											<input name="sku" id="sku" type="text" class="form-control" placeholder="SKU">
										</div>
										<div class="form-group col-2 col-md-3 pl-0">
											<small class="help">
												<a tabindex="0" class="btn badge badge-pill badge-secondary badge-light" role="button" data-toggle="tooltip" title="Agrega una imagen (jpp) de 120px x 120px">
													<i class="material-icons">help</i>
												</a>
											</small>
										</div>
									</div>
								</div>
								<h4>Precio</h4>
								<div class="container-fluid row align-items-center justify-content-start">
									<div class="d-flex col-12 col-sm-12 col-md-12 col-lg-4">
										<div class="form-group">
											<input name="precio" id="precio" type="text" class="form-control" placeholder="Precio de lista">
										</div>
									</div>

									<div class="d-flex col-12 col-sm-12 col-md-12 col-lg-4">
										<div class="form-group">
											<input name="oferta" id="oferta" type="text" class="form-control" placeholder="Precio oferta">
										</div>
									</div>
								</div>

								<h4>VISIBILIDAD</h4>
								<div class="container-fluid row align-items-center justify-content-start">
									<div class="d-flex col-12 col-sm-12 col-md-12 col-lg-6">
										<div class="form-group custom-control custom-radio custom-control-inline">
											<input type="radio" id="visibilidadShow_add" name="visibilidad_add" class="custom-control-input" checked>
											<label class="custom-control-label" for="visibilidadShow_add">Mostrar</label>
										</div>
										<div class="form-group custom-control custom-radio custom-control-inline">
											<input type="radio" id="visibilidadHide_add" name="visibilidad_add" class="custom-control-input">
											<label class="custom-control-label" for="visibilidadHide_add">Ocultar</label>
										</div>
									</div>
								</div>

								<div class="form-group d-flex justify-content-end pt-4 border-top">
									<a tabindex="0" class="btn" role="button" data-toggle="tooltip" title="Eliminar">
										<i class="material-icons">delete</i>
									</a>
									<a class="crear_producto btn btn-primary" id="agregarProductoImagenes-tab" data-toggle="tab" href="#agregarProductoImagenes" role="tab" aria-controls="agregarProductoImagenes" aria-selected="false">
										Agregar producto
									</a>
								</div>
							</div>
						</div>

						<div class="tab-pane fade show" id="editarProductoAtributos" role="tabpanel" aria-labelledby="editarProductoAtributos-tab">
							<div class="board-body">
								<h4>Atributos del producto</h4>
								<div class="atributo_contenedor1 pt-4 pb-3 pl-3 mr-0 ml-0">
									<div class="container-fluid row col-12 justify-content-start align-items-center">
										<div class="form-group col-3">
											Asignar un atributo:
										</div>
										<div class="form-group col-7">
											<select class="custom-select" id="atributoProducto" rows="3">
												<option>Selecciona un atributo</option>
												@if(count($atributos)>0)
													@foreach($atributos as $nkey=>$atr)
														<option value={{$atr->id}}>{{$atr->atributo}}</option>
													@endforeach
												@endif
											</select>
										</div>
									</div>
									<div class="container-fluid row col-12 justify-content-start align-items-center pr-0">
										<div class="col-3"></div>
										<div class="col-9 pl-0 pr-0">
											<div class="col-12 d-inline-flex justify-content-start pb-2">
												<a href="#" data-toggle="collapse" data-target="#collapseCrearAtributo" aria-expanded="false" aria-controls="collapseCrearAtributo">Crear un nuevo atributo</a>
											</div>
										</div>
									</div>
									<div class="container-fluid row col-12 justify-content-start align-items-center">
										<div class="col-12 col-sm-3"></div>
										<div class="col-12 col-sm-9 pl-0 pr-0">
											<div class="col-12 d-inline-flex justify-content-start pb-2 pr-0">
												<div class="collapse hide col-12 pr-0 pl-0" id="collapseCrearAtributo">
													<div class="agregar-atributos container-fluid row justify-content-start align-items-center pt-2 pl-0 pr-0 mr-0 ml-0">
														<div class="col-12 d-flex pl-0 pr-0">
															<div class="form-group">
																<input type="text" class="form-control nuevo_atributo nombre-nueva-categoria" placeholder="Atributo">
															</div>
															<div class="form-group pl-2">
																<input id="valores" type="text" class="form-control nombre-nueva-categoria" placeholder="Agrega valores separados por comas.">
															</div>
															<div class="form-group pl-2">
																<a class="crear_atributo btn btn-primary">+</a>
															</div>
															<div class="form-group">
																<small class="help">
																	<a tabindex="0" class="btn badge badge-pill badge-secondary badge-light" role="button" data-toggle="tooltip" title="Agrega un atributo">
																		<i class="material-icons">help</i>
																	</a>
																</small>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="atributo_contenedor2 pt-4 pb-3 pl-3 mr-0 ml-0 border-top">
									@if(count($atributos)>0)
										@foreach($atributos as $nkey=>$atr)
											<div class="container-fluid row col-12 justify-content-start align-items-center">
												<div class="form-group col-3">
													{{$atr->atributo}}:
												</div>
												<div class="form-group col-7">
													<select class="custom-select" id="atributoProducto" name="atributoProductoVal[{{$atr->id}}]" rows="3">
														<?php $values = json_decode($atr->valor) ?>
														@foreach($values as $val)
															<option value="{{$val}}">{{$val}}</option>
														@endforeach
													</select>
												</div>
												<div class="form-group col-2">
													<a href="#" class="badge-pill eliminarAtributo shadow-sm">
														<i class="material-icons">clear</i>
													</a>
												</div>
											</div>
										@endforeach
									@endif
								</div>
								<div class="form-group d-flex justify-content-end pt-4 border-top">
									<a tabindex="0" class="btn" role="button" data-toggle="tooltip" title="Eliminar">
										<i class="material-icons">delete</i>
									</a>
									<a class="crear_producto btn btn-primary" id="agregarProductoImagenes-tab" data-toggle="tab" href="#agregarProductoImagenes" role="tab" aria-controls="agregarProductoImagenes" aria-selected="false">
										Agregar producto
									</a>
								</div>
							</div>
						</div>

						<div class="tab-pane fade show" id="editarProductoVinculacion" role="tabpanel" aria-labelledby="editarProductoVinculacion-tab">
							<div class="board-body">
								<h4>Vincular con otros productos (OPCIONAL)</h4>
								<div class="pt-4 pb-3 pl-3 mr-0 ml-0">
									<div class="container-fluid row col-12 justify-content-start align-items-center">
										<div class="form-group col-8">
											<select id="producto_vincular" name="vinculacionProductoVal[]" class="custom-select" placeholder="Buscar producto a vincular">
												@if(count($producto)>0)
													@foreach($producto as $nkey=>$prod)
														<option value="{{$prod->id}}">{{$prod->producto}}</option>
													@endforeach
												@endif
											</select>
										</div>
										<div class="form-group">
											<a class="crear_vinculacion btn btn-primary">Vincular</a>
										</div>
									</div>
								</div>
								<div class="pt-4 pb-3 pl-3 mr-0 ml-0 border-top">
									<div class="container_vinculacion container-fluid row col-12 justify-content-start align-items-center">
										@if(count($producto)>0)
											<?php $productosVinculados = json_decode($prod->vinculacion) ?>
											@if($productosVinculados)
												@foreach($productosVinculados as $pv)
													<div class="container-fluid row col-12 justify-content-start align-items-center">
														<div class="form-group col-9">
															<div class="d-inline-flex"><img src="{{ asset('images/producto-icon.jpg') }}" alt="..." class="thumbnail border-top border-bottom border-right border-left">{{getProductsNameByIds($pv)}}</div>
														</div>
														<div class="form-group col-3">
															<a class="badge-pill eliminarRelacion shadow-sm">
																<i class="material-icons">clear</i>
															</a>
														</div>
													</div>
												@endforeach
											@endif
										@endif
									</div>
								</div>

								<div class="form-group d-flex justify-content-end pt-4 border-top">
									<a tabindex="0" class="btn" role="button" data-toggle="tooltip" title="Cancelar / Descontinuar Producto">
										<i class="material-icons">delete</i>
									</a>
									<a class="crear_producto btn btn-primary" id="agregarProductoImagenes-tab" data-toggle="tab" href="#agregarProductoImagenes" role="tab" aria-controls="agregarProductoImagenes" aria-selected="false">
										Agregar producto
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
