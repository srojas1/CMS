@extends('layouts.default')

@section('title')
    Nuevo Atributo
@stop

@section('top')
    <div class="page-header">
        <h1>Crear Atributo</h1>
    </div>
@stop

@section('content')
    <div class="well">
        <?php
        $form = ['url' => URL::route('atributo.store'),
            'method'   => 'POST',
            'button'   => 'Crear Atributo',
            'defaults' => [
                'atributo'    => ''
        ], ];
        ?>
        @include('atributos.form')
    </div>
@stop

@section('css')
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-markdown/2.8.0/css/bootstrap-markdown.min.css">
@stop

@section('js')
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-markdown/2.8.0/js/bootstrap-markdown.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
@stop
