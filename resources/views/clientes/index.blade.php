@extends('layouts.default')

@section('title')
    Clientes
@stop

@section('top')
    <div class="page-header">
        <h1>Clientes</h1>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-8">
            <p class="lead">
                @if (count($cliente) == 0)
                    No hay clientes registrados por el momento
                @else
                    Lista de Clientes:
                @endif
            </p>
        </div>
    </div>
    <hr>
    <div class="well">
        <table class="table">
            <thead>
            <th>Cliente/Usuario</th>
            <th>Distrito</th>
            <th>Ranking</th>
            <th>Puntos</th>
            <th>Ultimo acceso</th>
            <th>Ultima compra</th>
            <th>Total pedidos</th>
            <th>Total compras</th>
            <th>Acciones</th>
            </thead>
            <tbody>
            @foreach ($cliente as $cli)
                <tr>
                    <td>{{$cli->nombres}} {{$cli->apaterno}} {{$cli->amaterno}} </td>
                    <td>Ate</td>
                    <td>10</td>
                    <td>{{$cli->puntos}}</td>
                    <td>{{$cli->last_login}}</td>
                    <td>Ultima compra</td>
                    <td>2</td>
                    <td>29,192.00</td>
                    <td>
                        <a class="btn btn-info" href="{!! URL::route('cliente.edit', array('cliente' => $cli->id)) !!}"><i class="fa fa-pencil-square-o"></i></a>
                        <a class="btn btn-danger" href="#delete_cliente_{!! $cli->id !!}" data-toggle="modal" data-target="#delete_cliente_{!! $cli->id !!}" data-toggle="modal" data-target="#delete_cliente_{!! $cli->id !!}"><i class="fa fa-times"></i></a>&nbsp
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop

@section('bottom')
        @include('clientes.deletes')
@stop