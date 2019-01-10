@extends('layouts.default')

@section('title')
	Chat
@stop

@section('content')
@auth('chat')
	<div class="modulo container-fluid">
		<!--- CABECERA DE MÓDULO --->
		<div class="modulo-head row">
			<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-7"><h2>Chat</h2></div>
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