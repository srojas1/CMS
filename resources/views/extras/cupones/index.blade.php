<!--- CONTENIDO DE MÓDULO--->
<div class="modulo-body shadow-sm border-left border-right border-button">
	<div class="container-fluid">
		<div class="table-responsive">
			<table class="table">
				<div class="inside_add_div">
					<a href="#modalAgregarCupon" class="" data-toggle="modal" data-target="#modalAgregarCupon">Agregar cupón (+)</a>
				</div>
				<br>
				<thead class="thead-light">
				<tr>
					<th scope="col"><div class="d-flex justify-content-center">CUPÓN</div></th>
					<th scope="col"><div class="d-flex justify-content-center">CONDICIONAL</div></th>
					<th scope="col"><div class="d-flex justify-content-center">DESCUENTO</div></th>
					<th scope="col"><div class="d-flex justify-content-center">VENCIMIENTO</div></th>
					<th scope="col"><div class="d-flex justify-content-center">STOCK</div></th>
					<th scope="col"><div class="d-flex justify-content-center">RECLAMADOS</div></th>
					<th scope="col"><div class="d-flex justify-content-center">ACCIONES</div></th>
				</tr>
				</thead>
				<tbody>
				@if(count($cupon)>0)
					@foreach ($cupon as $cup)
							<tr>
								<th scope="row" class="align-middle">
									<div class="d-flex align-items-center">{{$cup->cupon}}</div>
								</th>
								<td class="align-middle">
									<div class="d-flex justify-content-center">{{$cup->condicion}}</div>
								</td>
								<td class="align-middle">
									<div class="d-flex justify-content-center">S/ {{$cup->descuento}}</div>
								</td>
								<td class="align-middle">
									<div class="d-flex justify-content-center">{{$cup->vencimiento}}</div>
								</td>
								<td class="align-middle">
									<div class="d-flex justify-content-center">{{$cup->stock_maximo}}</div>
								</td>
								<td class="align-middle">
									<div class="d-flex justify-content-center">[nro. reclamados]</div>
								</td>
								<td class="align-middle">
									<div class="d-flex justify-content-center">
										<a href="" class="accion">
											<i class="material-icons">remove_red_eye</i>
										</a>
										<a href="#modalEditarCupon_{!! $cup->id !!}" class="accion"
										   data-toggle="modal"
										   data-target="#modalEditarCupon_{!! $cup->id !!}">
											<i class="material-icons">edit</i>
										</a>
										<a href="#delete_cupon_{!! $cup->id !!}" data-toggle="modal" data-target="#delete_cupon_{!! $cup->id !!}" class="accion">
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
{{--{!! $links !!}--}}
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