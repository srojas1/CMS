	<div class="modal fade" id="modalAgregarProducto" tabindex="-1" role="dialog" aria-labelledby="modalAgregarProducto" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
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
							<a class="nav-link active" id="agregarProductoDescripcion-tab" data-toggle="tab" href="#agregarProductoDescripcion" role="tab" aria-controls="agregarProductoDescripcion" aria-selected="true">1. Descripción</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="agregarProductoImagenes-tab" data-toggle="tab" href="#agregarProductoImagenes" role="tab" aria-controls="agregarProductoImagenes" aria-selected="false">2. Imágenes</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="agregarProductoInventario-tab" data-toggle="tab" href="#agregarProductoInventario" role="tab" aria-controls="agregarProductoInventario" aria-selected="false">3. Inventario</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="agregarProductoAtributos-tab" data-toggle="tab" href="#agregarProductoAtributos" role="tab" aria-controls="agregarProductoAtributos" aria-selected="false">4. Atributos</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="agregarProductoVinculacion-tab" data-toggle="tab" href="#agregarProductoVinculacion" role="tab" aria-controls="agregarProductoVinculacion" aria-selected="false">5. Vinculación</a>
						</li>
					</ul>
				</div>
				<div class="tab-content" id="agregarProdcutoTABcontent">
					<div class="tab-pane fade show active" id="agregarProductoDescripcion" role="tabpanel" aria-labelledby="agregarProductoDescripcion-tab">
						<div class="board-body">
							<h4>Descripción del producto</h4>
							<div class="container-fluid">
								<div class="form-group">
									<input type="text" class="form-control" id="nombreProducto" aria-describedby="nombreProductoHelp" placeholder="Nombre de producto">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" id="codigoProducto" aria-describedby="codigoProductoHelp" placeholder="Código de producto">
								</div>
								<div class="form-group">
									<textarea class="form-control" id="descripcionProducto" rows="3" aria-describedby="descripcionProductoHelp" placeholder="Añade una pequeña descripción"></textarea>
								</div>
								<div class="form-group">
									<h4>
										Categoría del producto
									</h4>
									<div class="form-group">
										<select class="custom-select" id="categoriaProducto" rows="3">
											@if($categoria->count() > 0)
												@foreach($categoria as $key => $cats)
													{{--@if ($cats->id == $form['defaults']['id_categoria'])--}}
														{{--<option value={{$cats->id}} selected>{{$cats->categoria}}</option>--}}
													{{--@else--}}
														<option value="{{$cats->id}}">{{$cats->categoria}}</option>
													{{--@endif--}}
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
														<input type="text" class="form-control nombre-nueva-categoria nueva_categoria_inside" placeholder="Nombre de categoría">
													</div>
												</div>
												<div class="col-12 col-sm-12 col-md-5 col-lg-7 d-flex pl-0">
													<div class="form-group">
														<button type="submit" class="crear_categoria_inside btn btn-primary">Crear categoría</button>
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

					<div class="tab-pane fade show" id="agregarProductoImagenes" role="tabpanel" aria-labelledby="agregarProductoImagenes-tab">
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
													<input type="file" class="main_image custom-file-input justify-content-center" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
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
										Galería de producto
										<span class="help pl-3">
												<a tabindex="0" class="btn badge badge-pill badge-secondary badge-light" role="button" data-toggle="tooltip" title="Agrega una imagen 600px x 600px">
													<i class="material-icons">help</i>
												</a>
											</span>
										<div class="imagen-medidas row col-12">
											<small>.jpg .png | 350px x 140px</small>
										</div>
									</div>
									<div class="d-flex pt-4 row ml-1">

										<div class="agregar-imagen-galeria form-group mr-2">
											<div class="input-group">
												<div class="custom-file">
													<input type="file" class="gallery_image custom-file-input justify-content-center" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
													<label class="custom-file-label justify-content-center" for="inputGroupFile04">
														<i class="material-icons">add_photo_alternate</i>
													</label>
												</div>
											</div>
										</div>

										<div class="d-flex mr-2">
											<div class="form-group">
												<div class="inline-block position-relative">
													<img src="{{ asset('assets/img/demoproducto.jpg') }}" class="imagen-galeria shadow-sm border-top border-bottom border-right border-left">
													<a href="#" class="badge badge-light badge-pill eliminarImagen shadow-sm">
														<i class="material-icons">clear</i>
													</a>
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
								<a class="btn btn-primary" id="agregarProductoImagenes-tab" data-toggle="tab" href="#agregarProductoImagenes" role="tab" aria-controls="agregarProductoImagenes" aria-selected="false">
									Agregar producto
								</a>
							</div>
						</div>
					</div>

					<div class="tab-pane fade show" id="agregarProductoInventario" role="tabpanel" aria-labelledby="agregarProductoInventario-tab">
						<div class="board-body">
							<h4>Inventario del producto</h4>
							<div class="container-fluid row align-items-center justify-content-start">
								<div class="d-flex col-12 col-sm-12 col-md-12 col-lg-6">
									<div class="form-group custom-control custom-radio custom-control-inline">
										<input type="radio" id="customRadioInline1" name="customRadioInline" class="custom-control-input">
										<label class="custom-control-label" for="customRadioInline1">Muy pronto</label>
									</div>
									<div class="form-group custom-control custom-radio custom-control-inline">
										<input type="radio" id="customRadioInline2" name="customRadioInline" class="custom-control-input">
										<label class="custom-control-label" for="customRadioInline2">En stock</label>
									</div>
									<div class="form-group custom-control custom-radio custom-control-inline">
										<input type="radio" id="customRadioInline3" name="customRadioInline" class="custom-control-input">
										<label class="custom-control-label" for="customRadioInline3">Agotado</label>
									</div>
								</div>

								<div class="d-flex col-12 col-sm-12 col-md-12 col-lg-6">
									<div class="form-group col-10 col-md-9 pl-0">
										<input type="text" class="form-control" placeholder="SKU">
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
										<input type="text" class="form-control" placeholder="Precio de lista">
									</div>
								</div>

								<div class="d-flex col-12 col-sm-12 col-md-12 col-lg-4">
									<div class="form-group">
										<input type="text" class="form-control" placeholder="Precio oferta">
									</div>
								</div>
							</div>

							<h4>VISIBILIDAD</h4>
							<div class="container-fluid row align-items-center justify-content-start">
								<div class="d-flex col-12 col-sm-12 col-md-12 col-lg-6">
									<div class="form-group custom-control custom-radio custom-control-inline">
										<input type="radio" id="visibilidadShow" name="visibilidad" class="custom-control-input">
										<label class="custom-control-label" for="visibilidadShow">Mostrar</label>
									</div>
									<div class="form-group custom-control custom-radio custom-control-inline">
										<input type="radio" id="visibilidadHide" name="visibilidad" class="custom-control-input">
										<label class="custom-control-label" for="visibilidadHide">Ocultar</label>
									</div>
								</div>
							</div>

							<div class="form-group d-flex justify-content-end pt-4 border-top">
								<a tabindex="0" class="btn" role="button" data-toggle="tooltip" title="Eliminar">
									<i class="material-icons">delete</i>
								</a>
								<a class="btn btn-primary" id="agregarProductoImagenes-tab" data-toggle="tab" href="#agregarProductoImagenes" role="tab" aria-controls="agregarProductoImagenes" aria-selected="false">
									Agregar producto
								</a>
							</div>
						</div>
					</div>

					<div class="tab-pane fade show" id="agregarProductoAtributos" role="tabpanel" aria-labelledby="agregarProductoAtributos-tab">
						<div class="board-body">
							<h4>Atributos del producto</h4>
							<div class="pt-4 pb-3 pl-3 mr-0 ml-0">
								<div class="container-fluid row col-12 justify-content-start align-items-center">
									<div class="form-group col-3">
										Asignar un atributo:
									</div>
									<div class="form-group col-7">
										<select class="custom-select" id="atributoProducto" rows="3">
											<option>Selecciona un atributo</option>
											@foreach($atributos as $nkey=>$atr)
												<option value={{$atr->id}}>{{$atr->atributo}}</option>
											@endforeach
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
														<div class="crear_atributo form-group pl-2">
															<button type="submit" class="btn btn-primary">+</button>
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
							<div class="atributo_contenedor pt-4 pb-3 pl-3 mr-0 ml-0 border-top">
								@foreach($atributos as $nkey=>$atr)
									<div class="container-fluid row col-12 justify-content-start align-items-center">
										<div class="form-group col-3">
											{{$atr->atributo}}:
										</div>
										<div class="form-group col-7">
											<select class="custom-select" id="categoriaProducto" rows="3">
												<option>Selecciona un valor</option>
												<?php $values = json_decode($atr->valor) ?>
												@foreach($values as $val)
													<option>{{$val}}</option>
												@endforeach
											</select>
										</div>
										{{--<div class="form-group col-2">--}}
											{{--<a href="#" class="badge-pill eliminarAtributo shadow-sm">--}}
												{{--<i class="material-icons">clear</i>--}}
											{{--</a>--}}
										{{--</div>--}}
									</div>
								@endforeach
							</div>
							<div class="form-group d-flex justify-content-end pt-4 border-top">
								{{--<a tabindex="0" class="btn" role="button" data-toggle="tooltip" title="Eliminar">--}}
									{{--<i class="material-icons">delete</i>--}}
								{{--</a>--}}
								<a class="btn btn-primary" id="agregarProductoImagenes-tab" data-toggle="tab" href="#agregarProductoImagenes" role="tab" aria-controls="agregarProductoImagenes" aria-selected="false">
									Agregar producto
								</a>
							</div>
						</div>
					</div>

					<div class="tab-pane fade show" id="agregarProductoVinculacion" role="tabpanel" aria-labelledby="agregarProductoVinculacion-tab">
						<div class="board-body">
							<h4>Vincular con otros productos (OPCIONAL)</h4>
							<div class="pt-4 pb-3 pl-3 mr-0 ml-0">
								<div class="container-fluid row col-12 justify-content-start align-items-center">
									<div class="form-group col-8">
										<select id="producto_vincular" placeholder="Buscar producto a vincular">
											@foreach($producto as $nkey=>$prod)
												<option value="{{$prod->id}}">{{$prod->producto}}</option>
											@endforeach
										</select>
									</div>
									<div class="form-group">
										<button type="submit" class="crear_vinculacion btn btn-primary">Vincular</button>
									</div>
								</div>
							</div>
							<div class="pt-4 pb-3 pl-3 mr-0 ml-0 border-top">
								<div class="container_vinculacion container-fluid row col-12 justify-content-start align-items-center">
									<div class="form-group col-9">
										<div class="d-inline-flex"><img src="{{ asset('assets/img/producto-icon.jpg') }}" alt="..." class="thumbnail border-top border-bottom border-right border-left">Cervezas Cusqueñas de 567ml.</div>
									</div>
									<div class="form-group col-3">
										<a href="#" class="badge-pill eliminarRelacion shadow-sm">
											<i class="material-icons">clear</i>
										</a>
									</div>
								</div>
							</div>

							<div class="form-group d-flex justify-content-end pt-4 border-top">
								<a tabindex="0" class="btn" role="button" data-toggle="tooltip" title="Cancelar / Descontinuar Producto">
									<i class="material-icons">delete</i>
								</a>
								<a class="btn btn-primary" id="agregarProductoImagenes-tab" data-toggle="tab" href="#agregarProductoImagenes" role="tab" aria-controls="agregarProductoImagenes" aria-selected="false">
									Agregar producto
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>