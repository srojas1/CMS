<!--- CABECERA DE MÓDULO --->
<div class="modulo-head row">
	<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-5">
		<div class="input-group">
			<a class="btn btn-primary" href="{!! URL::route('recompensa.create') !!}">Agregar Recompensa</a>
		</div>
	</div>
</div>
<!--- CONTENIDO DE MÓDULO--->
<div class="modulo-body shadow-sm border-left border-right border-button">
	<div class="container-fluid">
		<div class="table-responsive">
			<table class="table">
				<thead class="thead-light">
				<tr>
					<th scope="col">RECOMPENSA</th>
					<th scope="col">PUNTOS</th>
					<th scope="col">DESRIPCIÓN</th>
					<th scope="col">ACCIONES</th>
				</tr>
				</thead>
				<tbody>
				@foreach ($recompensa as $rec)
					<tr>
						<th scope="row">{{$rec->recompensa}}</th>
						<td>{{$rec->puntos}}</td>
						<td>{{$rec->descripcion}}</td>
						<td>
							<a class="btn btn-info" href="{!! URL::route('recompensa.edit', array('recompensa' => $rec->id)) !!}"><i class="fa fa-pencil-square-o"></i></a>
							<a class="btn btn-danger" href="#delete_recompensa_{!! $rec->id !!}" data-toggle="modal" data-target="#delete_recompensa_{!! $rec->id !!}"><i class="fa fa-times"></i></a>&nbsp
						</td>
					</tr>
				@endforeach
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

@section('bottom')
	@auth('edit')
		@include('extras.recompensas.deletes')
	@endauth
@stop