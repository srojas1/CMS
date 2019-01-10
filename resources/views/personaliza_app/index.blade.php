@extends('layouts.default')

@section('title')
	Personaliza tu app
@stop

@section('content')
@auth('personaliza_app')
	<div class="modulo container-fluid">
		<!--- CABECERA DE MÓDULO --->
		<div class="modulo-head row">
			<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-7"><h2>Personaliza tu app</h2></div>
		</div>
		<div>
			<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-7">Módulo en construcción</div>
		</div>
	</div>
	{{--<!--- FOOTER DE CMS --->--}}
	{{--<div class="footer">--}}
	{{--<div class="container-fluid">--}}
	{{--<span>@Copyright</span>--}}
	{{--</div>--}}
	{{--</div>--}}
@endauth
@stop