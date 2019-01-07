<!--- CONTENIDO DE MÓDULO--->
<div class="modulo-body shadow-sm border-left border-right border-button">
	<div class="container-fluid">
		<div class="table-responsive">
			<table class="table">
				<div class="inside_add_div">
					<a href="#modalAgregarRecompensa" class="" data-toggle="modal" data-target="#modalAgregarRecompensa">Agregar recompensa (+)</a>
				</div>
				<br>
				<thead class="thead-light">
				<tr>
					<th scope="col"><div class="d-flex justify-content-center">RECOMPENSA</div></th>
					<th scope="col"><div class="d-flex justify-content-center">PUNTOS</div></th>
					<th scope="col"><div class="d-flex justify-content-center">DESRIPCIÓN</div></th>
					<th scope="col"><div class="d-flex justify-content-center">ACCIONES</div></th>
				</tr>
				</thead>
				<tbody>
				@if(count($recompensa)>0)
					@foreach ($recompensa as $rec)
						<tr>
							<th scope="row" class="align-middle">
								<div class="d-flex align-items-center">{{$rec->recompensa}}</div>
							</th>
							<td class="align-middle">
								<div class="d-flex justify-content-center">{{$rec->puntos}}</div>
							</td>
							<td class="align-middle">
								<div class="d-flex justify-content-center">{{$rec->descripcion}}</div>
							</td>
							<td class="align-middle">
								<div class="d-flex justify-content-center">
									<a href="" class="accion">
										<i class="material-icons">remove_red_eye</i>
									</a>
									<a href="#modalEditarRecompensa_{!! $rec->id !!}" class="accion"
									   data-toggle="modal"
									   data-target="#modalEditarRecompensa_{!! $rec->id !!}">
										<i class="material-icons">edit</i>
									</a>
									<a href="#delete_recompensa_{!! $rec->id !!}" data-toggle="modal" data-target="#delete_recompensa_{!! $rec->id !!}" class="accion">
										<i class="material-icons">close</i>
									</a>
								</div>
							</td>
						</tr>
					@endforeach
				@endif
				</tbody>
			</table>
		</div>
	</div>
</div>
{!! $links !!}
<!--- FOOTER DEL MODULO --->
<div class="modulo-footer">
	<div class="container-fluid">
		<div class="row justify-content-end">
			<nav aria-label="...">
				<ul class="pagination">
					<li class="page-item disabled">
						<a class="page-link" href="#" tabindex="-1">1</a>
					</li>
					<li class="page-item"><a class="page-link" href="#">2</a></li>
					<li class="page-item"><a class="page-link" href="#">3</a></li>
				</ul>
			</nav>
		</div>
		<div class="row justify-content-end tools">
			<a href="" class="">Exportar a excel</a>
		</div>
	</div>
</div>