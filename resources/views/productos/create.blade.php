@extends('layouts.default')

@section('title')
    Nuevo Producto
@stop

@section('top')
    <div class="page-header">
        <h1>Crear Producto</h1>
    </div>
@stop

@section('content')
    <div class="well">
		<?php
		$form = ['url' => URL::route('producto.store'),
			'method'   => 'POST',
			'button'   => 'Crear Producto',
			'defaults' => [
				'producto'    => '',
				'codigo'    => '',
                'descripcion' => '',
                'id_categoria'=>'',
                'id_stock' =>'',
                'precio' => '',
                'oferta' => ''
			], ];
		?>
        @include('productos.form')
    </div>
@stop

@section('css')
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-markdown/2.8.0/css/bootstrap-markdown.min.css">
@stop

@section('js')
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-markdown/2.8.0/js/bootstrap-markdown.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
@stop
