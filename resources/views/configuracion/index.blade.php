{{--@extends('layouts.default')--}}

{{--@section('title')--}}
	{{--Configuración--}}
{{--@stop--}}

{{--@section('content')--}}
	{{--<div class="modulo container-fluid">--}}
		{{--<div class="modulo clientes container-fluid">--}}
			{{--<!--- CABECERA DE MÓDULO --->--}}
			{{--<div class="board-head row pb-4">--}}
				{{--<div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-4 pb-4">--}}
					{{--<h2>Configuración</h2>--}}
				{{--</div>--}}
				{{--<div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-2 d-flex align-items-center justify-content-end pb-4">--}}

				{{--</div>--}}
				{{--<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 d-flex align-items-center justify-content-end pb-4">--}}
					{{--<div class="row input-group searchbox-position">--}}
						{{--<div class="input-group-prepend">--}}
							{{--<div class="input-group-text"><i class="material-icons">search</i></div>--}}
						{{--</div>--}}
						{{--<input type="text" class="form-control buscador" placeholder="Buscar usuario">--}}
					{{--</div>--}}
				{{--</div>--}}
			{{--</div>--}}
			{{--<!--- CONTENIDO DE MÓDULO--->--}}
			{{--<div class="board-tabs">--}}
				{{--<ul class="nav nav-tabs" id="clientesTAB" role="tablist">--}}
					{{--<li class="nav-item">--}}
						{{--<a class="nav-link active" id="usuarios-tab" data-toggle="tab" href="#usuarios" role="tab" aria-controls="usuarios" aria-selected="true">Usuarios (CMS)</a>--}}
					{{--</li>--}}
				{{--</ul>--}}
			{{--</div>--}}
			{{--<div class="tab-content" id="clientesTABContent">--}}
				{{--<div class="tab-pane fade show active" id="usuarios" role="tabpanel" aria-labelledby="usuarios-tab">--}}
					{{--<div class="board-body shadow-sm border-left border-right border-bottom">--}}
						{{--<div class="container-fluid">--}}
							{{--<div class="table-responsive">--}}
								{{--<table class="table">--}}
									{{--<thead class="thead-light">--}}
									{{--<tr>--}}
										{{--<th scope="col"><div class="d-flex justify-content-center">USUARIO</div></th>--}}
										{{--<th scope="col"><div class="d-flex justify-content-center">EMAIL</div></th>--}}
										{{--<th scope="col"><div class="d-flex justify-content-center">EMPRESA</div></th>--}}
										{{--<th scope="col"><div class="d-flex justify-content-center">ACCIONES</div></th>--}}
									{{--</tr>--}}
									{{--</thead>--}}
									{{--<tbody>--}}
									{{--@foreach ($users as $user)--}}
										{{--<tr>--}}
											{{--<th scope="row" class="align-middle">--}}
												{{--<div class="d-flex align-items-center">{{$user->name}}</div>--}}
											{{--</th>--}}
											{{--<td class="align-middle">--}}
												{{--<div class="d-flex justify-content-center"> {{$user->email}}</div>--}}
											{{--</td>--}}
											{{--<td class="align-middle">--}}
												{{--<div class="d-flex justify-content-center"> EMPRESA 1</div>--}}
											{{--</td>--}}
											{{--<td class="align-middle">--}}
												{{--<div class="d-flex justify-content-center">--}}
													{{--<a href="#modalEditarUsuario" class="accion"--}}
													   {{--data-toggle="modal"--}}
													   {{--data-target="#modalEditarUsuario">--}}
														{{--<i class="material-icons">edit</i>--}}
													{{--</a>--}}
													{{--<a href="{!! URL::route('configuracion.create', array('users' => $user->id)) !!}" class="accion">--}}
													{{--<a href="" class="accion">--}}
														{{--<i class="material-icons">lock</i>--}}
													{{--</a>--}}
													{{--<a href="#delete_user" data-toggle="modal" data-target="#delete_user" class="accion">--}}
														{{--<i class="material-icons">close</i>--}}
													{{--</a>--}}
												{{--</div>--}}
											{{--</td>--}}
										{{--</tr>--}}
									{{--@endforeach--}}
									{{--</tbody>--}}
								{{--</table>--}}
							{{--</div>--}}
						{{--</div>--}}
					{{--</div>--}}
				{{--</div>--}}
			{{--</div>--}}
			{{--<!--- FOOTER DEL MODULO --->--}}
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
			{{--<!--- FOOTER DE CMS --->--}}
			{{--<div class="footer">--}}
				{{--<div class="container-fluid">--}}
					{{--<span>@Copyright</span>--}}
				{{--</div>--}}
			{{--</div>--}}
		{{--</div>--}}
	{{--<!--- FOOTER DE CMS --->--}}
	{{--<div class="footer">--}}
	{{--<div class="container-fluid">--}}
	{{--<span>@Copyright</span>--}}
	{{--</div>--}}
	{{--</div>--}}
{{--@stop--}}