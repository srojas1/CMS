<div class="row">
	<div class="col-xs-8">
		<p class="lead">
		</p>
	</div>
	<div class="col-xs-4">
		<div class="pull-right">
			<br>
			<a class="btn btn-primary" href="{!! URL::route('recompensa.create') !!}">Agregar Recompensa</a>
		</div>
	</div>
</div>
<br>
<div class="well">
	<table class="table">
		<thead>
		<th>RECOMPENSA</th>
		<th>PUNTOS</th>
		<th>DESRIPCIÓN</th>
		<th>ACCIONES</th>
		</thead>
		<tbody>
		@foreach ($recompensa as $rec)
		<tr>
			<td>{{$rec->recompensa}}</td>
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

@section('bottom')
	@auth('edit')
		@include('extras.recompensas.deletes')
	@endauth
@stop