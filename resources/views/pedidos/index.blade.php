@extends('layouts.default')

@section('title')
    Pedidos
@stop

@section('content')
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
                <div class="modulo-tabs">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Recibidos ({{getCantidadElementos($pedido)}})</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Histórico ({{getCantidadElementos($pedido)}})</a>
                        </li>
                    </ul>
                </div>
                <div class="modulo-body shadow-sm border-left border-right border-button">
                    <div class="container-fluid">
                        <div class="table-responsive">
                            <table class="table">
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
                                    <th scope="row">#{{formatNumber($ped->id)}} {{$ped->getClientById->nombres}}
                                        {{$ped->getClientById->apaterno}}
                                        {{$ped->getClientById->amaterno}}</th>
                                    <td>Hace {{timeSince($ped->fecha_pedido)}}</td>
                                    <td>S/ {{$ped->total}}</td>
                                    <td>Direccion Test</td>
                                    @if ($ped->getStatusById->estado)
                                        <td>
                                            <button type="button" class="btn_modal btn {{getColorByStatus($ped->id_estado)}}" href="#detail_pedido_{!! $ped->id !!}"
                                               data-toggle="modal"
                                               data-target="#detail_pedido_{!! $ped->id !!}">{{$ped->getStatusById->estado}}</button>
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
                <!--- FOOTER DEL MODULO --->
                {{--<div class="modulo-footer">--}}
                    {{--<div class="container-fluid">--}}
                        {{--<div class="row justify-content-end">--}}
                            {{--<nav aria-label="...">--}}
                                {{--<ul class="pagination">--}}
                                    {{--<li class="page-item disabled">--}}
                                        {{--<a class="page-link" href="#" tabindex="-1">1</a>--}}
                                    {{--</li>--}}
                                    {{--<li class="page-item"><a class="page-link" href="#">2</a></li>--}}
                                    {{--<li class="page-item"><a class="page-link" href="#">3</a></li>--}}
                                {{--</ul>--}}
                            {{--</nav>--}}
                        {{--</div>--}}
                        {{--<div class="row justify-content-end tools">--}}
                            {{--<a href="" class="">Exportar a excel</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
        <!--- FOOTER DE CMS --->
        <div class="footer">
            <div class="container-fluid">
                <span>@Copyright</span>
            </div>
        </div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
@stop

@section('bottom')
    @include('pedidos.detail')
@stop
