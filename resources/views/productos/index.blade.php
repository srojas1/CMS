@extends('layouts.default')

@section('title')
    Productos
@stop

@section('content')
@auth('producto')
    <div class="modulo container-fluid">
		<!--- MÓDULO --->
			<div class="modulo productos container-fluid">
				<!--- CABECERA DE MÓDULO --->
				<div class="board-head row pb-4">
					<div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-4 pb-4">
						<h2>Productos</h2>
					</div>
					<div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-2 d-flex align-items-center justify-content-end pb-4">
						<div>
							<a href="#modalAgregarProducto" class="" data-toggle="modal" data-target="#modalAgregarProducto">Agregar producto (+)</a>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 d-flex align-items-center justify-content-end pb-4">
						<div class="row input-group searchbox-position">
							<div class="input-group-prepend">
								<div class="input-group-text"><i class="material-icons">search</i></div>
							</div>
							<input type="text" class="form-control buscador" placeholder="Buscar producto">
						</div>
					</div>
				</div>
				<!--- CONTENIDO DE MÓDULO--->
				<div class="tabpanel">
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item">
							<a class="productos nav-link active" data-toggle="tab" href="#productos">Productos ({{getCantidadElementos($producto)}})</a>
						</li>
						<li id="category_tab" class="nav-item">
							<a class="categorias nav-link" data-toggle="tab" href="#categorias">Categorías ({{getCantidadElementos($categoria)}})</a>
						</li>
					</ul>
					<div class="tab-content">
						<div role="tabpanel"
							 class="tab-pane active" id="productos">
							<div class="modulo-body shadow-sm border-left border-right border-button">
								<div class="container-fluid">
									<div class="table-responsive">
										<table class="page table table-hover table_producto">
											<thead class="thead-light">
											<tr>
												<th scope="col"><div class="d-flex justify-content-center">PRODUCTO</div></th>
												<th scope="col"><div class="d-flex justify-content-center">CATEGORÍA</div></th>
												<th scope="col"><div class="d-flex justify-content-center">STOCK</div></th>
												<th scope="col"><div class="d-flex justify-content-center">PRECIO</div></th>
												<th scope="col"><div class="d-flex justify-content-center">OFERTA</div></th>
												<th scope="col"><div class="d-flex justify-content-center">VENTAS</div></th>
												<th scope="col"><div class="d-flex justify-content-center">INGRESOS</div></th>
												<th scope="col"><div class="d-flex justify-content-center">ACCIONES</div></th>
											</tr>
											</thead>
											<tbody>
											<tr>
												@if(count($producto)>0)
													@foreach ($producto as $prod)
															@if($prod->imagen_principal!='[""]')
																<th scope="row" class="align-middle" href="#modalEditarProducto_{!! $prod->id !!}" class="accion"
																	data-toggle="modal"
																	data-target="#modalEditarProducto_{!! $prod->id !!}">
																<div class="d-flex align-items-center"></div><img src="{{ asset('images/'.getJsonValue($prod->imagen_principal))}}" alt="..." class="thumbnail border-top border-bottom border-right border-left">{{$prod->producto}}</th>
															@else
																<th scope="row" class="align-middle" href="#modalEditarProducto_{!! $prod->id !!}" class="accion"
																	data-toggle="modal"
																	data-target="#modalEditarProducto_{!! $prod->id !!}"><div class="d-flex align-items-center"></div><img src="{{ asset('images/'.\GrahamCampbell\BootstrapCMS\Http\Constants::DEFAULT_IMAGE_NAME)}}" alt="..." class="thumbnail border-top border-bottom border-right border-left">{{$prod->producto}}</th>
															@endif
															@if($prod->getCategoryById)
																<td class="align-middle"><div class="d-flex justify-content-center">{{$prod->getCategoryById->categoria}}</div></td>
															@else
																<td class="align-middle"><div class="d-flex justify-content-center">Sin categoria existente</div></td>
															@endif
															<td class="align-middle"><div class="d-flex justify-content-center"> {{getStockName($prod->id_stock)}}</div></td>
															<td class="align-middle"><div class="d-flex justify-content-center">S/ {{$prod->precio}}</div></td>
															<td class="align-middle"><div class="d-flex justify-content-center">S/ {{$prod->oferta}}</div></td>
															<?php $sumVentas= 0 ?>
															<?php $ord_prod= array();?>
															@if($prod->orders)
																@foreach($prod->orders as $key=>$ord_prod)
																	<?php $sumVentas+=$ord_prod->pivot->cantidad?>
																@endforeach
															@endif
															<td class="align-middle"><div class="d-flex justify-content-center">{{$sumVentas}}</div></td>
															<?php $ingreso=$sumVentas*$prod->precio?>
															<td class="align-middle">
																<div class="d-flex justify-content-center">
																	S/ {{number_format($ingreso,2)}}</div></td>
															<td class="align-middle">
																<div class="d-flex justify-content-center">
																	@if($prod->visibilidad==1)
																		<a href="#detail_disableprod_{!! $prod->id !!}"
																		   data-toggle="modal"
																		   data-target="#detail_disableprod_{!! $prod->id !!}" class="accion">
																			<i class="material-icons">remove_red_eye</i>
																		</a>
																	@else
																		<a href="#detail_disableprod_{!! $prod->id !!}"
																		   data-toggle="modal"
																		   data-target="#detail_disableprod_{!! $prod->id !!}" class="accion">
																			<i class="material-icons">remove_circle_outline</i>
																		</a>
																	@endif
																	<a href="#modalEditarProducto_{!! $prod->id !!}" class="accion"
																	   data-toggle="modal"
																	   data-target="#modalEditarProducto_{!! $prod->id !!}">
																		<i class="material-icons">edit</i>
																	</a>
																	<input type="hidden" id="hid_visibilidad" value="{{$prod->visibilidad}}"/>
																	<a href="#delete_producto_{!! $prod->id !!}" data-toggle="modal" data-target="#delete_producto_{!! $prod->id !!}" class="accion">
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
						</div>
						@include('productos.index_categorias')
					</div>
				  </div>
			</div>
        </div>
	<ul id="pagination-demo" class="pagination-lg pull-right"></ul>
	<!--- FOOTER DEL MODULO --->
	{{--<div class="modulo-footer">--}}
		{{--<div class="container-fluid">--}}
			{{--<div class="row justify-content-end">--}}
				{{--<nav aria-label="..." class="pagination-position">--}}
					{{--<ul class="pagination">--}}
						{{--{!! $links !!}--}}
					{{--</ul>--}}
				{{--</nav>--}}
			{{--</div>--}}
			{{--<div class="row justify-content-end tools">--}}
				{{--<a href="" class="">Exportar a excel</a>--}}
			{{--</div>--}}
		{{--</div>--}}
	{{--</div>--}}
@endauth
@stop

@section('bottom')
	@auth('edit')
		@include('productos.deletes')
		@include('categorias.deletes')
	@endauth
	@if(count($producto)>0)
		@include('productos.detail_edit')
	@endif
		@include('productos.detail_create')
		@include('categorias.detail_edit')
		@include('productos.disable_view')
@stop

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/selectize.default.css')}}">
@stop
@section('js')
	<script type="text/javascript" src="{{ asset('assets/scripts/categorias.js')}}"></script>
	<script type="text/javascript" src="{{ asset('assets/scripts/productos.js')}}"></script>
	<script type="text/javascript" src="{{ asset('assets/scripts/jquery.twsPagination.js')}}"></script>
@endsection