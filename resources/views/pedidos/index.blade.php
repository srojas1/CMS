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
            </thead>
            <tbody>
            @foreach ($pedido as $ped)
                <tr>
                    <td>#{{$ped->id}} {{$ped->getClientById->nombres}}
                        {{$ped->getClientById->apaterno}}
                        {{$ped->getClientById->amaterno}}</td>
                    <td>{{timeSince($ped->fecha_pedido)}}</td>
                    <td>{{$ped->total}}</td>
                    <td>Direccion Test</td>
                    <td>{{$ped->id_estado}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop