@extends('layouts.default')

@section('title')
	Promociones y Recompensas
@stop

@section('content')
	<div class="modulo container-fluid">
	<!--- CABECERA DE MÓDULO --->
		<div class="modulo-head row">
			<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-7"><h2>Promociones y Recompensas</h2></div>
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
				</div>
				<div role="tabpanel"
					 class="tab-pane {{$arrStatus['cuponStatus']}}" id="cupones">
					@include('extras.cupones.index')
				</div>
				<div role="tabpanel"
					 class="tab-pane {{$arrStatus['recompensaStatus']}}" id="recompensas">
					@include('extras.recompensas.index')
				</div>
			</div>
		</div>
	</div>
@stop