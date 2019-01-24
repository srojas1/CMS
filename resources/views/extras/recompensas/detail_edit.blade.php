@foreach ($recompensa as $nkey=>$rec)
<div class="modal fade" id="modalEditarRecompensa_{!! $rec->id !!}" tabindex="-1" role="dialog" aria-labelledby="modalEditarRecompensa_{!! $rec->id !!}" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<form id="edit_recompensa_form_{!! $rec->id !!}" enctype="multipart/form-data" method="post">
			<div class="modal-content">
				<!--- MODAL HEADER --->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<div>
						<h3 class="modal-title">Editar Recompensa: {!! $rec->recompensa !!}</h3>
					</div>
				</div>
				<div class="board-body">
					<div class="container-fluid">
						<div class="form-group">
							<input name="nombreRecompensa" value="{{$rec->recompensa}}" type="text" class="form-control" id="nombreRecompensa" aria-describedby="nombreRecompensaHelp" placeholder="Nombre">
						</div>
						<div class="form-group">
							<input name="eventoRecompensa" value="{{$rec->evento}}" type="text" class="form-control" id="eventoRecompensa" aria-describedby="eventoRecompensaHelp" placeholder="Evento">
						</div>
						<div class="form-group">
							<input name="puntosRecompensa" value="{{$rec->puntos}}" type="text" class="form-control" id="puntosRecompensa" aria-describedby="puntosRecompensaHelp" placeholder="Puntos">
						</div>
						<div class="form-group">
							<textarea name="descripcionRecompensa" class="form-control" id="descripcionRecompensa" rows="3" aria-describedby="descripcionRecompensaHelp" placeholder="Descripción...">{{$rec->descripcion}}</textarea>
						</div>
						<div class="form-group d-flex justify-content-end pt-4 border-top">
							<input type="hidden" name="id_recompensa" class="id_recompensa" value="{{$rec->id}}"/>
							<a class="editar_recompensa btn btn-primary" id="editarRecompensa-tab" data-toggle="tab" href="#editarRecompensa" role="tab" aria-controls="editarRecompensa" aria-selected="false">
								Guardar recompensa
							</a>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
@endforeach