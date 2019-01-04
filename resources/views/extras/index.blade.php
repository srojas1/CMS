@extends('layouts.default')

@section('title')
	Promociones y Recompensas
@stop

@section('content')
	<div class="modulo container-fluid">
		<div class="modulo promociones container-fluid">
			<!--- CABECERA DE MÓDULO --->
			<div class="board-head row pb-4">
				<div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-4 pb-4">
					<h2>Promociones y Recompensas</h2>
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-2 d-flex align-items-center justify-content-end pb-4">
					{{--<div>--}}
						{{--<a href="#modalAgregarPromocion" class="" data-toggle="modal" data-target="#modalAgregarPromocion">Agregar (+)</a>--}}
					{{--</div>--}}
					{{--<div>--}}
						{{--<a href="#modalAgregarCupon" class="" data-toggle="modal" data-target="#modalAgregarCupon">Cupón (+)</a>--}}
					{{--</div>--}}
					{{--<div>--}}
						{{--<a href="#modalAgregarRecompensa" class="" data-toggle="modal" data-target="#modalAgregarRecompensa">Recomp. (+)</a>--}}
					{{--</div>--}}
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 d-flex align-items-center justify-content-end pb-4">
					<div class="row input-group searchbox-position">
						<div class="input-group-prepend">
							<div class="input-group-text"><i class="material-icons">search</i></div>
						</div>
						<input type="text" class="form-control buscador" placeholder="Buscar">
					</div>
				</div>
			</div>
		<!--- CONTENIDO DE MÓDULO--->
			<div class="tabpanel">
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#promociones">Promociones</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#cupones">Cupones</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#recompensas">Recompensas</a>
					</li>
				</ul>
				<div class="tab-content">
					<div role="tabpanel"
						 class="tab-pane {{$arrStatus['promoStatus']}}" id="promociones">
						@include('extras.promociones.index')
						@include('extras.promociones.detail_create')
					</div>
					<div role="tabpanel"
						 class="tab-pane {{$arrStatus['cuponStatus']}}" id="cupones">
						@include('extras.cupones.index')
						@include('extras.cupones.detail_create')
					</div>
					<div role="tabpanel"
						 class="tab-pane {{$arrStatus['recompensaStatus']}}" id="recompensas">
						@include('extras.recompensas.index')
						@include('extras.recompensas.detail_create')
					</div>
				</div>
			</div>
		</div>
	</div>
@stop
@section('bottom')
	@include('extras.promociones.detail_create')
@stop

@section('js')
	<link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript" src="{{ asset('assets/scripts/promociones.js')}}"></script>
@stop