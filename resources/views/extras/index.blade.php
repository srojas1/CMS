@extends('layouts.default')

@section('title')
    Promociones y Recompensas
@stop

@section('top')
    <div class="page-header">
        <h1>Promociones y Recompensas</h1>
    </div>
@stop

@section('content')
    <div class="tabpanel">

        <ul class="nav nav-tabs" role="tablist">
            <li><a href="#promociones" data-toggle="tab">
                    <div class="row">
                        <div class="col-xs-8">
                            <p class="lead">
                                Promociones
                            </p>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="#cupones" data-toggle="tab">
                    <div class="row">
                        <div class="col-xs-8">
                            <p class="lead">
                                Cupones
                            </p>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <a href="#recompensas" data-toggle="tab">
                    <div class="row">
                        <div class="col-xs-8">
                            <p class="lead">
                                Recompensas
                            </p>
                        </div>
                    </div>
                </a>
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
@stop