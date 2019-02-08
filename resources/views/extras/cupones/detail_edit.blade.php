@foreach ($cupon as $nkey=>$cup)
<div class="modal fade" id="modalEditarCupon_{!! $cup->id !!}" tabindex="-1" role="dialog" aria-labelledby="modalEditarCupon_{!! $cup->id !!}" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<form id="edit_cupon_form_{!! $cup->id !!}" enctype="multipart/form-data" method="post">
			<div class="modal-content">
				<!--- MODAL HEADER --->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<div>
						<h3 class="modal-title">Editar Cupón: {!! $cup->cupon !!}</h3>
					</div>
				</div>
				<div class="board-body">
					<div class="container-fluid">
						<div class="form-group">
							<input name="nombreCupon" value="{{$cup->cupon}}" type="text" class="form-control" id="nombreCupon" aria-describedby="nombreCuponHelp" placeholder="Cupón">
						</div>
						<div class="form-group">
							<input name="descuentoCupon" value="{{$cup->descuento}}" type="text" class="form-control" id="descuentoCupon" aria-describedby="descuentoCuponHelp" placeholder="Descuento">
						</div>
						<div class="form-group">
							<input name="vencimientoCupon" value="{{$cup->vencimiento}}" type="text" class="form-control" id="vencimientoCupon" aria-describedby="vencimientoCuponHelp" placeholder="Vencimiento">
						</div>
						<div class="form-group">
							<input name="stockMaximoCupon" value="{{$cup->stock_maximo}}" type="text" class="form-control" id="stockMaximoCupon" aria-describedby="stockMaximoCuponHelp" placeholder="Stock Máximo">
						</div>
						<div class="form-group">
							<input name="condicionPromocion" value="{{$cup->condicion}}" type="text" class="form-control" id="condicionPromocion" aria-describedby="condicionPromocionHelp" placeholder="Condición">
						</div>
						<h4>Agregar cupón a cliente</h4>
						<div class="form-group">
							<div class="container-fluid row col-12 justify-content-start align-items-center">
								<div class="form-group col-6">
									<select id="cliente_vincular_cupon_{!! $cup->id !!}" name="vinculacionClienteVal[]" class="custom-select">
										@foreach($cliente as $nkey=>$cliVinc)
											<option value="{{$cliVinc->id}}">{{$cliVinc->nombres}} {{$cliVinc->apaterno}} {{$cliVinc->amaterno}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<a class="crear_vinculacion_cliente_edit btn btn-primary">Vincular</a>
								</div>
							</div>
						</div>
						<div class="pt-4 pb-3 pl-3 mr-0 ml-0 border-top">
							<div class="container_vinculacion_{!! $cup->id !!} container-fluid row col-12 justify-content-start align-items-center">
								@if($cup->getClientsById)
									@foreach($cup->getClientsById as $nkey=>$cliCup)
										@if(!$cliCup->pivot->deleted_at)
											<div class="container-fluid row col-12 justify-content-start align-items-center">
												<div class="form-group col-5">
													<input name="productoVinculadoPromoEdit[]" type="hidden" value="{{$cliCup->pivot->id}}"/>
													<div class="d-inline-flex">
														<img src="{{asset('images/'.getJsonValue($cliCup->imagen_principal))}}" alt="..." class="thumbnail border-top border-bottom border-right border-left"> {{$cliCup->nombres}} {{$cliCup->apaterno}} {{$cliCup->amaterno}}
													</div>
												</div>
												<div class="form-group col-3">
													<a href="#" class="badge-pill eliminarRelacionCupon shadow-sm">
														<i class="material-icons">clear</i>
													</a>
												</div>
											</div>
										@endif
									@endforeach
								@endif
							</div>
						</div>
						<div class="form-group d-flex justify-content-end pt-4 border-top">
							<input type="hidden" name="id_cupon" class="id_cupon" value="{{$cup->id}}"/>
							<a class="editar_cupon btn btn-primary" id="editarCupon-tab" data-toggle="tab" href="#editarCupon" role="tab" aria-controls="editarCupon" aria-selected="false">
								Guardar cupón
							</a>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
@endforeach