@extends('layouts.default')

@section('title')
    Pedidos
@stop

@section('content')
@auth('pedido')
        <div class="modulo container-fluid">
            <!--- MÓDULO --->
            <div class="modulo pedidos container-fluid">
                <!--- CABECERA DE MÓDULO --->
                <div class="modulo-head row pb-4">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-7"><h2>Pedidos</h2></div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-5">
                        <div class="input-group searchbox-position">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="material-icons">search</i></div>
                            </div>
                            <input type="text" class="form-control buscador" placeholder="Buscar pedido">
                        </div>
                    </div>
                </div>
                <!--- CONTENIDO DE MÓDULO--->
                <div class="tabpanel">
                    <div class="modulo-tabs">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="pedidos nav-link active" data-toggle="tab" href="#pedidos">Recibidos ({{getCantidadElementos($pedido)}})</a>
                            </li>
                            <li class="nav-item">
                                <a class="historico nav-link" data-toggle="tab" href="#historico">Histórico ({{getCantidadElementos($pedido)}})</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div role="tabpanel"
                             class="tab-pane active" id="pedidos">
                            <div class="modulo-body shadow-sm border-left border-right border-button">
                                <div class="container-fluid">
                                    <div class="table-responsive">
                                        <table class="table table-hover table_pedido">
                                            <thead class="thead-light">
                                            <tr>
                                                <th scope="col">PEDIDO</th>
                                                <th scope="col">RECIBIDO</th>
                                                <th scope="col">MONTO</th>
                                                <th scope="col">DESTINO</th>
                                                <th scope="col">ESTADO</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($pedido as $ped)
                                                <tr>
                                                    <th scope="row" href="#detail_pedido_{!! $ped->id !!}"
                                                        data-toggle="modal"
                                                        data-target="#detail_pedido_{!! $ped->id !!}">#{{formatNumber($ped->id)}} {{$ped->getClientById->nombres}} {{$ped->getClientById->apaterno}} {{$ped->getClientById->amaterno}}</th>
                                                    <td>Hace {{timeSince($ped->fecha_pedido)}}</td>
                                                    <td>S/ [cambiar total]</td>
                                                    @if($ped->getAddressById->direccion)
                                                        <td>{{$ped->getAddressById->direccion}}</td>
                                                    @else
                                                        <td>[sin direccion asignada]</td>
                                                    @endif
                                                    @if ($ped->getStatusById->estado)
                                                        <td>
                                                            <a class="btn_modal btn {{getColorByStatus($ped->id_estado)}}" href="#detail_pedido_{!! $ped->id !!}"
                                                               data-toggle="modal"
                                                               data-target="#detail_pedido_{!! $ped->id !!}">{{$ped->getStatusById->estado}}</a>
                                                        </td>
                                                    @else
                                                        <td>{{\GrahamCampbell\BootstrapCMS\Http\Constants::STATUS_EMPTY}}</td>
                                                    @endif
                                                    <input type="hidden" class="id_pedido" value="{{$ped->id}}"/>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel"
                             class="tab-pane" id="historico">
                            <div class="modulo-body shadow-sm border-left border-right border-button">
                                <div class="container-fluid">
                                    <div class="table-responsive">
                                        <table class="table table-hover table_historico">
                                            <thead class="thead-light">
                                            <tr>
                                                <th scope="col">PEDIDO HISTÓRICO</th>
                                                <th scope="col">RECIBIDO</th>
                                                <th scope="col">MONTO</th>
                                                <th scope="col">DESTINO</th>
                                                <th scope="col">ESTADO</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pedido as $ped)
                                                    <tr>
                                                        <th scope="row"> #{{formatNumber($ped->id)}} {{$ped->getClientById->nombres}} {{$ped->getClientById->apaterno}} {{$ped->getClientById->amaterno}}</th>
                                                        <td>Hace {{timeSince($ped->fecha_pedido)}}</td>
                                                        <td>S/ [cambiar total]</td>
                                                        @if($ped->getAddressById)
                                                            <td>{{$ped->getAddressById->direccion}}</td>
                                                        @else
                                                            <td>[sin direccion asignada]</td>
                                                        @endif
                                                        @if ($ped->getStatusById->estado)
                                                            <td>
                                                                <button type="button" class="btn_modal btn {{getColorByStatus($ped->id_estado)}}">{{$ped->getStatusById->estado}}</button>
                                                            </td>
                                                        @else
                                                            <td>{{\GrahamCampbell\BootstrapCMS\Http\Constants::STATUS_EMPTY}}</td>
                                                        @endif
                                                        <input type="hidden" class="id_pedido" value="{{$ped->id}}"/>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--- FOOTER DE CMS --->
        <div class="footer">
            <div class="container-fluid">
                <span>@Copyright</span>
            </div>
        </div>
@endauth
@stop
@section('js')
    <script type="text/javascript" src="{{ asset('assets/scripts/pedidos.js')}}"></script>
@endsection

@section('bottom')
    @include('pedidos.detail')
@stop
