@extends('layouts.default')

@section('title')
    Productos
@stop

@section('content')
    <div class="modulo container-fluid">
        <!--- CABECERA DE MÓDULO --->
        <div class="modulo-head row">
			<div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-4 pb-4">
				<h2>Productos</h2>
			</div>

			<div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-2 d-flex align-items-center justify-content-end pb-4">
				<div>
					<a href="#modalAgregarProducto" class="" data-toggle="modal" data-target="#modalAgregarProducto">Agregar producto (+)</a>
				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 d-flex align-items-center justify-content-end pb-4">
				<div class="row input-group">
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
                    <a class="nav-link active" data-toggle="tab" href="#productos">Productos ({{getCantidadElementos($producto)}})</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#categorias">Categorías ({{getCantidadElementos($categoria)}})</a>
                </li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel"
                     class="tab-pane active" id="productos">
                    <div class="modulo-body shadow-sm border-left border-right border-button">
                        <div class="container-fluid">
                            <div class="table-responsive">
                                <table class="table table-hover">
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
                                    @foreach ($producto as $prod)
                                        <tr>
                                            <th scope="row" class="align-middle"><div class="d-flex align-items-center"><img src="{{ asset('images/producto-icon.jpg') }}" alt="..." class="thumbnail border-top border-bottom border-right border-left">{{$prod->producto}}</th>
											<td class="align-middle"><div class="d-flex justify-content-center">{{$prod->getCategoryById->categoria}}</div></td>
											<td class="align-middle"><div class="d-flex justify-content-center"> {{getStockName($prod->id_stock)}}</div></td>
                                            <td class="align-middle"><div class="d-flex justify-content-center">S/ {{$prod->precio}}</td>
                                            <td class="align-middle"><div class="d-flex justify-content-center">S/ {{$prod->oferta}}</td>
                                            <?php $sumVentas= 0 ?>
                                            @foreach($prod->orders as $key=>$ord_prod)
                                                <?php $sumVentas+=$ord_prod->pivot->cantidad?>
                                            @endforeach
                                            <td class="align-middle"><div class="d-flex justify-content-center">{{$sumVentas}}</td>
                                            <?php $ingreso=$sumVentas*$prod->precio?>
                                            <td class="align-middle"><div class="d-flex justify-content-center">S/ {{number_format($ingreso,2)}}</td>
											<td class="align-middle"><div class="d-flex justify-content-center">
													<a href="" class="accion">
														<i class="material-icons">remove_red_eye</i>
													</a>
													<a href="#modalEditarProducto_{!! $prod->id !!}" class="accion"
													   data-toggle="modal"
													   data-target="#modalEditarProducto_{!! $prod->id !!}">
														<i class="material-icons">edit</i>
													</a>
													<a href="#delete_producto_{!! $prod->id !!}" data-toggle="modal" data-target="#delete_producto_{!! $prod->id !!}" class="accion">
														<i class="material-icons">close</i>
													</a>
												</div>
											</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel"
                     class="tab-pane" id="categorias">
                    <div class="board-body shadow-sm border-left border-right border-bottom">
                        <div class="container-fluid">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="thead-light">
                                    <tr>
										<th scope="col"><div class="d-flex justify-content-center">CATEGORÍA</div></th>
										<th scope="col"><div class="d-flex justify-content-center">PRODUCTOS</div></th>
										<th scope="col"><div class="d-flex justify-content-center">VENTAS</div></th>
										<th scope="col"><div class="d-flex justify-content-center">INGRESOS</div></th>
										<th scope="col"><div class="d-flex justify-content-center">ACCIONES</div></th>
                                    </tr>
                                    </thead>
                                    <tbody>
										<tr>
											<td colspan="5">
												<form>
													<div class="crear-categoria d-flex justify-content-start pt-3">
														<div class="form-group">
															<div class="input-group">
																<div class="custom-file">
																	<input type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
																	<label class="custom-file-label" for="inputGroupFile04"><i class="material-icons">add_photo_alternate</i></label>
																</div>
															</div>
														</div>
														<div class="form-group">
															<input type="text" class="form-control nombre-nueva-categoria nueva_categoria" placeholder="Nombre de categoría">
														</div>
														<div class="form-group">
															<button type="submit" class="crear_categoria btn btn-primary">Crear categoría</button>
														</div>
														<div class="form-group">
															<small class="help">
																<a tabindex="0" class="btn badge badge-pill badge-secondary badge-light" role="button" data-toggle="tooltip" title="Agrega una imagen (jpp) de 120px x 120px">
																	<i class="material-icons">help</i>
																</a>
															</small>
														</div>
													</div>
												</form>
											</td>
										</tr>
										@foreach ($categoria as $key1=>$cat)
										<tr>
											<th scope="row" class="align-middle"><div class="d-flex align-items-center"><img src="{{ asset('images/producto-icon.jpg') }}" alt="..." class="thumbnail border-top border-bottom border-right border-left"><div>{{$cat->categoria}}</div></div></th>
											<?php $sumProductos = 0 ?>
											@foreach($cat->products as $key=>$cat)
												<?php $sumProductos++?>
											@endforeach
											<td class="align-middle"><div class="d-flex justify-content-center">{{$sumProductos}}</div></td>
											<td class="align-middle"><div class="d-flex justify-content-center">29</div></td>
											<td class="align-middle"><div class="d-flex justify-content-center">S/ 1970.00</div></td>
											<td class="align-middle">
												<div class="d-flex justify-content-center">
													<a href="" class="accion">
														<i class="material-icons">remove_red_eye</i>
													</a>
													<a href="{!! URL::route('categoria.edit', array('categoria' => $cat->id)) !!}" class="accion">
														<i class="material-icons">edit</i>
													</a>
													<a href="#delete_categoria_{!! $cat->id !!}" data-toggle="modal" data-target="#delete_categoria_{!! $cat->id !!}" class="accion">
														<i class="material-icons">close</i>
													</a>
												</div>
											</td>
										</tr>
										@endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
    <!--- FOOTER DEL MODULO --->
    <div class="modulo-footer">
        <div class="container-fluid">
            {{--<div class="row justify-content-end">--}}
                {{--<nav aria-label="...">--}}
                    {{--<ul class="pagination">--}}
                        {{--{!! $links !!}--}}
                    {{--</ul>--}}
                {{--</nav>--}}
            {{--</div>--}}
            <div class="row justify-content-end tools">
                <a href="" class="">Exportar a excel</a>
            </div>
        </div>
    </div>
@stop

@section('bottom')
    @auth('edit')
        @include('productos.deletes')
		@include('categorias.deletes')
    @endauth
    @include('productos.detail_create')
	@include('productos.detail_edit')
@stop

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/selectize.default.css')}}">
@stop
@section('js')
	<script type="text/javascript" src="{{ asset('assets/scripts/selectize.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('assets/scripts/categorias.js')}}"></script>
	<script type="text/javascript" src="{{ asset('assets/scripts/productos.js')}}"></script>
@endsection