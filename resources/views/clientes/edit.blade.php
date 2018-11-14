@extends('layouts.default')

@section('title')
    Editar {{ $cliente->cliente }}
@stop

@section('top')
    <div class="page-header">
        <h1>Editar {{ $cliente->cliente }}</h1>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-6">
            <p class="lead">
                Editar cliente:
            </p>
        </div>
        <div class="col-xs-6">
            <div class="pull-right">
                {{--<a class="btn btn-success" href="{!! URL::route('cliente.show', array('cliente' => $cliente->id)) !!}"><i class="fa fa-file-text"></i> Mostrar clientes</a>--}}
                {{--<a class="btn btn-danger" href="#delete_cliente" data-toggle="modal" data-target="#delete_cliente"><i class="fa fa-times"></i>Eliminar</a>--}}
            </div>
        </div>
    </div>
    <hr>
    <div class="well">
        <?php
        $form = ['url' => URL::route('cliente.update',['cliente' => $cliente->id]),
            '_method'   => 'PATCH',
            'method' => 'POST',
            'button'   => 'Actualizar cliente',
            'defaults' => [
                'cliente'   => $cliente->cliente,
                'nombres'   => $cliente->nombres,
                'apaterno'   => $cliente->apaterno,
                'amaterno'   => $cliente->amaterno,
                'movil'      => $cliente->movil,
                'email'      => $cliente->email,
                'fecha_nacimiento' => $cliente->fecha_nacimiento,
                'documento'      => $cliente->documento,
                'ranking'      => 10,
                'puntos'      => $cliente->puntos,
                'last_login'      => $cliente->last_login,
            ], ];
        ?>
        @include('clientes.form')
    </div>
@stop

{{--@section('bottom')--}}
    {{--@auth('edit')--}}
        {{--@include('clientes.delete')--}}
    {{--@endauth--}}
{{--@stop--}}

@section('css')
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-markdown/2.8.0/css/bootstrap-markdown.min.css">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css">
@stop

@section('js')
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-markdown/2.8.0/js/bootstrap-markdown.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js"></script>
    <script>
        js_datetime_format = '{{ Config::get('date.js_format') }}';
    </script>
    <script type="text/javascript" src="{{ asset('assets/scripts/cms-picker.js') }}"></script>
@stop
