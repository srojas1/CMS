<div class="modal fade" id="modalAgregarPromocion" tabindex="-1" role="dialog" aria-labelledby="modalAgregarPromocion" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<form id="create_promocion_form" enctype="multipart/form-data" method="post">
			<div class="modal-content">
				<!--- MODAL HEADER --->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<div>
						<h3 class="modal-title">Agregar Promoción</h3>
					</div>
				</div>
				<div class="board-body">
					<div class="container-fluid">
						<div class="form-group">
							<input name="nombrePromocion" type="text" class="form-control" id="nombrePromocion" aria-describedby="nombrePromocionHelp" placeholder="Promoción">
						</div>
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
											<input type="file" name="imagen_principal" class="main_image custom-file-input justify-content-center" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
											<label class="custom-file-label custom-file-label-promo justify-content-center" for="inputGroupFile04">
												<i class="material-icons">add_photo_alternate</i>
											</label>
											<div class="d-flex">
												<div class="form-group">
													<div class="inline-block position-relative">
														<img class="imagen-featured shadow-sm border-top border-bottom border-right border-left" src="#" style="width: 80px; height: 80px; margin-top: 16px;" >
														<a href="#" class="badge badge-light badge-pill eliminarImagen shadow-sm">
															<i class="material-icons">clear</i>
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="d-flex mr-2">
									<div class="form-group">
										<div class="inline-block position-relative multiple-images-add">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div>
							<div class="container-fluid row col-12 justify-content-start align-items-center">
								<div class="form-group col-6">
									<select id="producto_vincular_promo" name="vinculacionProductoValPromo[]" class="custom-select">
										@if(count($producto)>0)
											@foreach($producto as $nkey=>$prod)
												<option value="{{$prod->id}}">{{$prod->producto}}</option>
											@endforeach
										@endif
									</select>
								</div>
								<div class="form-group">
									<a class="crear_vinculacion_promo btn btn-primary">Vincular</a>
								</div>
							</div>
						</div>
						<div class="pt-4 pb-3 pl-3 mr-0 ml-0 border-top">
							<div class="container_vinculacion_promo container-fluid row col-12 justify-content-start align-items-center">
							</div>
						</div>
						<div class="form-group">
							<input name="precioPromocion" type="text" class="form-control" id="precioPromocion" aria-describedby="precioPromocionHelp" placeholder="Precio">
						</div>
						<div class="form-group">
							<input name="stockMaximoPromocion" type="text" class="form-control" id="stockMaximoPromocion" aria-describedby="stockMaximoPromocionHelp" placeholder="Stock Máximo">
						</div>
						<div class="form-group">
							<input name="lanzamientoPromocion" type="text" class="form-control" id="lanzamientoPromocion" aria-describedby="lanzamientoPromocionHelp" placeholder="Lanzamiento">
						</div>
						<div class="form-group">
							<input name="fechaFinPromocion" type="text" class="form-control" id="fechaFinPromocion" aria-describedby="fechaFinPromocionHelp" placeholder="Fecha fin">
						</div>
						<div class="form-group d-flex justify-content-end pt-4 border-top">
							<a class="crear_promocion btn btn-primary" id="agregarPromocion-tab" data-toggle="tab" href="#agregarPromocion" role="tab" aria-controls="agregarPromocion" aria-selected="false">
								Agregar promoción
							</a>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>