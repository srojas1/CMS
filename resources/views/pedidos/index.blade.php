@extends('layouts.default')

@section('title')
    Pedidos
@stop

@section('top')
    <div class="page-header">
        <h1>Pedidos</h1>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-8">
            <p class="lead">
                @if (count($pedido) == 0)
                    No hay pedidos registrados por el momento
                @else
                    Lista de Pedidos:
                @endif
            </p>
        </div>
    </div>
    <hr>
    <div class="well">
        <table class="table">
            <thead>
            <th>PEDIDO</th>
            <th>RECIBIDO</th>
            <th>MONTO</th>
            <th>DESTINO</th>
            <th>ESTADO</th>
            <th></th>
            </thead>
            <tbody>
            @foreach ($pedido as $ped)
                <tr>
                    <td>#{{$ped->id}} {{$ped->getClientById->nombres}}
                        {{$ped->getClientById->apaterno}}
                        {{$ped->getClientById->amaterno}}</td>
                    <td>Hace {{timeSince($ped->fecha_pedido)}}</td>
                    <td>S/ {{$ped->total}}</td>
                    <td>Direccion Test</td>
                    <td>{{$ped->getStatusById->estado}}</td>
                    <td>
                        <a class="btn btn-success"
                           href="#detail_pedido_{!! $ped->id !!}"
                           data-toggle="modal"
                           data-target="#detail_pedido_{!! $ped->id !!}">
                           <i class="fa fa-info"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop

@section('bottom')
    @include('pedidos.detail')
@stop