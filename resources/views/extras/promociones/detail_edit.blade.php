@foreach ($promocion as $nkey=>$prom)
<div class="modal fade" id="modalEditarPromocion_{!! $prom->id !!}" tabindex="-1" role="dialog" aria-labelledby="modalEditarPromocion_{!! $prom->id !!}" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<form id="edit_promocion_form_{!! $prom->id !!}" enctype="multipart/form-data" method="post">
			<div class="modal-content">
				<!--- MODAL HEADER --->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<div>
						<h3 class="modal-title">Editar Promoción: {{$prom->promocion}}</h3>
					</div>
				</div>
				<div class="board-body">
					<div class="container-fluid">
						<div class="form-group">
							<input name="nombrePromocion" value="{{$prom->promocion}}" type="text" class="form-control" id="nombrePromocion" aria-describedby="nombrePromocionHelp" placeholder="Promoción">
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
									@if($prom->imagen_principal!='[""]')
										<img src="{{ asset('images/'.getJsonValue($prom->imagen_principal))}}" class="imagen-featured shadow-sm border-top border-bottom border-right border-left">
										<a href="#" class="badge badge-light badge-pill eliminarImagenEdit shadow-sm">
											<i class="material-icons">clear</i>
										</a>
									@else
										<img src="{{ asset('images/'.\GrahamCampbell\BootstrapCMS\Http\Constants::DEFAULT_IMAGE_NAME)}}" class="imagen-featured shadow-sm border-top border-bottom border-right border-left">
									@endif
								</div>
							</div>
						</div>

						<div class="pt-4 pb-3 pl-3 mr-0 ml-0">
							<div class="container-fluid row col-12 justify-content-start align-items-center">
								<div class="form-group col-8">
									<select id="producto_vincular_promo_{!! $prom->id !!}" class="custom-select" name="vinculacionProductoVal[]">
										@foreach($producto as $nkey=>$prodVinc)
											<option value="{{$prodVinc->id}}">{{$prodVinc->producto}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<button type="button" class="crear_vinculacion_promo_edit btn btn-primary">Vincular</button>
								</div>
							</div>
						</div>
						<div class="pt-4 pb-3 pl-3 mr-0 ml-0 border-top">
							<div class="container_vinculacion_{!! $prom->id !!} container-fluid row col-12 justify-content-start align-items-center">
								<?php $productosVinculados = json_decode($prom->vinculacion_producto) ?>
								@if($productosVinculados)
									@foreach($productosVinculados as $pv)
										<div class="container-fluid row col-12 justify-content-start align-items-center">
											<div class="form-group col-9">
												<input name="productoVinculadoPromoEdit[]" type="hidden" value="{{$pv}}"/>
												<div class="d-inline-flex">
													<img src="{{ asset('images/'.getJsonValue(getProductMainImageById($pv)))}}" alt="..." class="thumbnail border-top border-bottom border-right border-left">{{getProductsNameByIds($pv)}}</div>
											</div>
											<div class="form-group col-3">
												<a href="#" class="badge-pill eliminarRelacionPromo shadow-sm">
													<i class="material-icons">clear</i>
												</a>
											</div>
										</div>
									@endforeach
								@endif
							</div>
						</div>


						<div class="form-group">
							<input name="precioPromocion" value="{{$prom->precio}}" type="text" class="form-control" id="precioPromocion" aria-describedby="precioPromocionHelp" placeholder="Precio">
						</div>
						<div class="form-group">
							<input name="stockMaximoPromocion" value="{{$prom->stock_maximo}}" type="text" class="form-control" id="stockMaximoPromocion" aria-describedby="stockMaximoPromocionHelp" placeholder="Stock Máximo">
						</div>
						<div class="form-group">
							<input name="lanzamientoPromocion" value="{{$prom->fecha_inicio}}" type="text" class="form-control" id="lanzamientoPromocion" aria-describedby="lanzamientoPromocionHelp" placeholder="Lanzamiento">
						</div>
						<div class="form-group">
							<input name="fechaFinPromocion" value="{{$prom->fecha_fin}}" type="text" class="form-control" id="fechaFinPromocion" aria-describedby="fechaFinPromocionHelp" placeholder="Fecha fin">
						</div>
						<div class="form-group d-flex justify-content-end pt-4 border-top">
							<input type="hidden" name="id_promocion" class="id_promocion" value="{{$prom->id}}"/>
							<a class="editar_promocion btn btn-primary" id="EditarPromocion-tab" data-toggle="tab" href="#EditarPromocion" role="tab" aria-controls="EditarPromocion" aria-selected="false">
								Guardar Promoción
							</a>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
@endforeach