<!--- CONTENIDO DE MÓDULO--->
<div class="modulo-body shadow-sm border-left border-right border-button">
	<div class="container-fluid">
		<div class="table-responsive">
			<table class="table table-hover">
				<div class="inside_add_div">
					<a href="#modalAgregarPromocion" class="" data-toggle="modal" data-target="#modalAgregarPromocion">Agregar promoción (+)</a>
				</div>
				<br>
				<thead class="thead-light">
				<tr>
					<th scope="col"><div class="d-flex justify-content-center">PROMOCIÓN</div></th>
					<th scope="col"><div class="d-flex justify-content-center">PRODUCTOS RELACIONADOS</div></th>
					<th scope="col"><div class="d-flex justify-content-center">PRECIO</div></th>
					<th scope="col"><div class="d-flex justify-content-center">FECHA INICIO</div></th>
					<th scope="col"><div class="d-flex justify-content-center">FECHA FIN</div></th>
					<th scope="col"><div class="d-flex justify-content-center">STOCK MAXIMO</div></th>
					<th scope="col"><div class="d-flex justify-content-center">VENTAS</div></th>
					<th scope="col"><div class="d-flex justify-content-center">INGRESOS</div></th>
					<th scope="col"><div class="d-flex justify-content-center">ACCIONES</div></th>
				</tr>
				</thead>
				<tbody>
				@if(count($promocion)>0)
					@foreach ($promocion as $prom)
						<tr>
							@if($prom->filename_main)
								<th scope="row" class="align-middle"><div class="d-flex align-items-center"></div><img src="{{ asset('images/'.getJsonValue($prom->filename_main))}}" alt="..." class="thumbnail border-top border-bottom border-right border-left">{{$prom->promocion}}</th>
							@else
								<th scope="row" class="align-middle"><div class="d-flex align-items-center"></div><img src="{{ asset('images/'.\GrahamCampbell\BootstrapCMS\Http\Constants::DEFAULT_IMAGE_NAME)}}" alt="..." class="thumbnail border-top border-bottom border-right border-left">{{$prom->promocion}}</th>
							@endif
							<td class="align-middle">
								<div class="d-flex justify-content-center">
								<?php $productosVinculados = json_decode($prom->vinculacion_producto) ?>
									@if($productosVinculados)
										@foreach($productosVinculados as $pv)
											<img src="{{ asset('images/'.getJsonValue(getProductMainImageById($pv)))}}" alt="..." class="thumbnail border-top border-bottom border-right border-left">
										@endforeach
									@else
										<img src="{{ asset('images/'.\GrahamCampbell\BootstrapCMS\Http\Constants::DEFAULT_IMAGE_NAME)}}" alt="..." class="thumbnail border-top border-bottom border-right border-left">
									@endif
								</div>
							</td>
							<td class="align-middle">
								<div class="d-flex justify-content-center">S/ {{$prom->precio}}</div>
							</td>
							<td class="align-middle">
								<div class="d-flex justify-content-center">{{$prom->fecha_inicio}}</div>
							</td>
							<td class="align-middle">
								<div class="d-flex justify-content-center">{{$prom->fecha_fin}}</div>
							</td>
							<td class="align-middle">
								<div class="d-flex justify-content-center">{{$prom->stock_maximo}}</div>
							</td>
							<td class="align-middle">
								<div class="d-flex justify-content-center">[ventas]</div>
							</td>
							<td class="align-middle">
								<div class="d-flex justify-content-center">S/ [ingresos]</div>
							</td>
							<td class="align-middle">
								<div class="d-flex justify-content-center">
									<a href="" class="accion">
										<i class="material-icons">remove_red_eye</i>
									</a>
									<a href="#modalEditarPromocion_{!! $prom->id !!}" class="accion"
									   data-toggle="modal"
									   data-target="#modalEditarPromocion_{!! $prom->id !!}">
										<i class="material-icons">edit</i>
									</a>
									<a href="#delete_promocion_{!! $prom->id !!}" data-toggle="modal" data-target="#delete_promocion_{!! $prom->id !!}" class="accion">
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
		@include('extras.cupones.deletes')
		@include('extras.recompensas.deletes')
	@endauth
@stop