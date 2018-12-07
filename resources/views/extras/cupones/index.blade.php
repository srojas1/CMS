<!--- CABECERA DE MÓDULO --->
<div class="modulo-head row">
	<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-5">
		<div class="input-group">
			<a class="btn btn-primary" href="{!! URL::route('cupon.create') !!}">Agregar Cupón</a>
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
					<th scope="col">CUPÓN</th>
					<th scope="col">CONDICIONAL</th>
					<th scope="col">DESCUENTO</th>
					<th scope="col">VENCIMIENTO</th>
					<th scope="col">STOCK</th>
					<th scope="col">RECLAMADOS</th>
					<th scope="col">ACCIONES</th>
				</tr>
				</thead>
				<tbody>
				@foreach ($cupon as $cup)
					<tr>
						<th scope="row">{{$cup->cupon}}</th>
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
		@include('extras.cupones.deletes')
	@endauth
@stop