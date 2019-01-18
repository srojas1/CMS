<div class="modal fade" id="modalAgregarCupon" tabindex="-1" role="dialog" aria-labelledby="modalAgregarCupon" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<form id="create_cupon_form" enctype="multipart/form-data" method="post">
			<div class="modal-content">
				<!--- MODAL HEADER --->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<div>
						<h3 class="modal-title">Agregar Cupón</h3>
					</div>
				</div>
				<div class="board-body">
					<div class="container-fluid">
						<div class="form-group">
							<input name="nombreCupon" type="text" class="form-control" id="nombreCupon" aria-describedby="nombreCuponHelp" placeholder="Cupón">
						</div>
						<div class="form-group">
							<input name="descuentoCupon" type="text" class="form-control" id="descuentoCupon" aria-describedby="descuentoCuponHelp" placeholder="Descuento">
						</div>
						<div class="form-group">
							<input name="vencimientoCupon" type="text" class="form-control" id="vencimientoCupon" aria-describedby="vencimientoCuponHelp" placeholder="Vencimiento">
						</div>
						<div class="form-group">
							<input name="stockMaximoCupon" type="text" class="form-control" id="stockMaximoCupon" aria-describedby="stockMaximoCuponHelp" placeholder="Stock Máximo">
						</div>
						<div class="form-group">
							<input name="condicionPromocion" type="text" class="form-control" id="condicionPromocion" aria-describedby="condicionPromocionHelp" placeholder="Condición">
						</div>
						<h4>Agregar cupón a cliente</h4>
						<div class="form-group">
							<div class="container-fluid row col-12 justify-content-start align-items-center">
								<div class="form-group col-6">
									<select id="cliente_vincular_cupon" name="vinculacionClienteVal[]" class="custom-select">
										@if(count($cliente)>0)
											@foreach($cliente as $nkey=>$cli)
												<option value="{{$cli->id}}">{{$cli->nombres}} {{$cli->apaterno}} {{$cli->amaterno}}</option>
											@endforeach
										@endif
									</select>
								</div>
								<div class="form-group">
									<a class="crear_vinculacion_cliente btn btn-primary">Vincular</a>
								</div>
							</div>
						</div>
						<div class="pt-4 pb-3 pl-3 mr-0 ml-0 border-top">
							<div class="container_vinculacion_promo container-fluid row col-12 justify-content-start align-items-center">
							</div>
						</div>
						<div class="form-group d-flex justify-content-end pt-4 border-top">
							<a class="crear_cupon btn btn-primary" id="agregarCupon-tab" data-toggle="tab" href="#agregarCupon" role="tab" aria-controls="agregarCupon" aria-selected="false">
								Agregar cupón
							</a>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>