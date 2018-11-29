@extends('layouts.default')

@section('title')
    Nuevo Cupón
@stop

@section('top')
    <div class="page-header">
        <h1>Crear Cupón</h1>
    </div>
    <div class="row">
        <div class="col-xs-8">
            <p class="lead">
            </p>
        </div>
        <div class="col-xs-4">
            <div class="pull-right">
                <br>
                <a class="btn btn-success" href="{!! URL::route('promocion.index') !!}"> << Regresar</a>
            </div>
        </div>
    </div>
    <br>
@stop

@section('content')
    <div class="well">
        <?php
        $form = ['url' => URL::route('cupon.store'),
            'method'   => 'POST',
            'button'   => 'Crear Cupón',
            'defaults' => [
                'cupon'        => '',
                'descuento'    => '',
                'vencimiento'  => Carbon\Carbon::now()->format(Config::get('date.php_format')),
                'stock_maximo' => '',
                'condicion'    => '',
            ], ];
        ?>
        @include('extras.cupones.form')
    </div>
@stop

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