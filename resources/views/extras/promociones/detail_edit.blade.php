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