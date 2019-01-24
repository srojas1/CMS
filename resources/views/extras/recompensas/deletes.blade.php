@foreach ($recompensa as $rec)
	<div id="delete_recompensa_{!! $rec->id !!}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">¿Estás seguro?</h4>
				</div>
				<div class="modal-body">
					<p>Está a punto de eliminar una recompensa. Este proceso no puede ser desecho</p>
					<p>Está seguro que desea continuar?</p>
				</div>
				<div class="modal-footer">
					<a class="btn btn-success" href="{!! URL::route('recompensa.destroy', array('recompensa' => $rec->id)) !!}" data-token="{!! Session::getToken() !!}" data-method="DELETE">Sí</a>
					<button class="btn btn-danger" data-dismiss="modal">No</button>
				</div>
			</div>
		</div>
	</div>
@endforeach