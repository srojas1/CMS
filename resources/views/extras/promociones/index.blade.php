<!--- CABECERA DE MÓDULO --->
<div class="modulo-head row">
	<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-5">
		<div class="input-group">
			<a class="btn btn-primary" href="{!! URL::route('promocion.create') !!}">Agregar Promoción</a>
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
					<th scope="col">PROMOCIÓN</th>
					<th scope="col">PRODUCTOS RELACIONADOS</th>
					<th scope="col">PRECIO</th>
					<th scope="col">FECHA INICIO</th>
					<th scope="col">FECHA FIN</th>
					<th scope="col">STOCK MAXIMO</th>
					<th scope="col">VENTAS</th>
					<th scope="col">INGRESOS</th>
					<th scope="col">ACCIONES</th>
				</tr>
				</thead>
				<tbody>
				@foreach ($promocion as $prom)
					<tr>
						<th scope="row">{{$prom->promocion}}</th>
						<td>[imagen]</td>
						<td>{{$prom->precio}}</td>
						<td>{{$prom->fecha_inicio}}</td>
						<td>{{$prom->fecha_fin}}</td>
						<td>{{$prom->stock_maximo}}</td>
						<td>[ventas]</td>
						<td>[ingresos]</td>
						<td>
							<a class="btn btn-info" href=""><i class="fa fa-pencil-square-o"></i></a>
							<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_promocion_{!! $prom->id !!}"><i class="fa fa-times"></i></button>&nbsp
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
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
		@include('extras.promociones.deletes')
	@endauth
@stop