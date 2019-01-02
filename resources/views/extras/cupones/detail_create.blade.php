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
					</div>
				</div>
			</div>
		</form>
	</div>
</div>