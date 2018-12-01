<div class="row">
	<div class="col-xs-8">
		<p class="lead">
		</p>
	</div>
	<div class="col-xs-4">
		<div class="pull-right">
			<br>
			<a class="btn btn-primary" href="{!! URL::route('cupon.create') !!}">Agregar Cupón</a>
		</div>
	</div>
</div>
<hr>
<div class="well">
	<table class="table">
		<thead>
		<th>CUPÓN</th>
		<th>CONDICIONAL</th>
		<th>DESCUENTO</th>
		<th>VENCIMIENTO</th>
		<th>STOCK</th>
		<th>RECLAMADOS</th>
		<th>ACCIONES</th>
		</thead>
		<tbody>
		@foreach ($cupon as $cup)
		<tr>
			<td>{{$cup->cupon}}</td>
			<td>{{$cup->condicion}}</td>
			<td>{{$cup->descuento}}</td>
			<td>{{$cup->vencimiento}}</td>
			<td>{{$cup->stock_maximo}}</td>
			<td>[nro. reclamados]</td>
			<td>
				<a class="btn btn-info" href="{!! URL::route('cupon.edit', array('cupon' => $cup->id)) !!}"><i class="fa fa-pencil-square-o"></i></a>
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_cupon_{!! $cup->id !!}"><i class="fa fa-times"></i></button>&nbsp
			</td>
		</tr>
		@endforeach
		</tbody>
	</table>
</div>
{!! $links !!}

@section('bottom')
	@auth('edit')
		@include('extras.cupones.deletes')
	@endauth
@stop