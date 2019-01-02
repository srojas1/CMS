<div class="modal fade" id="modalAgregarRecompensa" tabindex="-1" role="dialog" aria-labelledby="modalAgregarRecompensa" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<form id="create_Recompensa_form" enctype="multipart/form-data" method="post">
			<div class="modal-content">
				<!--- MODAL HEADER --->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<div>
						<h3 class="modal-title">Agregar Recompensa</h3>
					</div>
				</div>
				<div class="board-body">
					<div class="container-fluid">
						<div class="form-group">
							<input name="nombreRecompensa" type="text" class="form-control" id="nombreRecompensa" aria-describedby="nombreRecompensaHelp" placeholder="Nombre">
						</div>
						<div class="form-group">
							<input name="eventoRecompensa" type="text" class="form-control" id="eventoRecompensa" aria-describedby="eventoRecompensaHelp" placeholder="Evento">
						</div>
						<div class="form-group">
							<input name="puntosRecompensa" type="text" class="form-control" id="puntosRecompensa" aria-describedby="puntosRecompensaHelp" placeholder="Puntos">
						</div>
						<div class="form-group">
							<textarea name="descripcionRecompensa" class="form-control" id="descripcionRecompensa" rows="3" aria-describedby="descripcionRecompensaHelp" placeholder="Descripción..."></textarea>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>