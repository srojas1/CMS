@extends('layouts.default')

@section('title')
    Clientes
@stop

@section('content')
    <div class="modulo container-fluid">
        <!--- CABECERA DE MÓDULO --->
        <div class="modulo-head row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-7"><h2>Clientes</h2></div>
            </div>
        </div>
        <!--- CONTENIDO DE MÓDULO--->
        <div class="modulo-body shadow-sm border-left border-right border-button">
            <div class="container-fluid">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">CLIENTE/USUARIO</th>
                            <th scope="col">DISTRITO</th>
                            <th scope="col">RANKING</th>
                            <th scope="col">PUNTOS</th>
                            <th scope="col">ÚLTIMO ACCESO</th>
                            <th scope="col">ÚLTIMA COMPRA</th>
                            <th scope="col">TOTAL PEDIDOS</th>
                            <th scope="col">TOTAL COMPRAS</th>
                            <th scope="col">ACCIONES</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($cliente as $cli)
                            <tr>
                                <th scope="row">{{$cli->nombres}} {{$cli->apaterno}} {{$cli->amaterno}}</th>
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
            </div>
        </div>
        <!--- FOOTER DEL MODULO --->
        <div class="modulo-footer">
            <div class="container-fluid">
                <div class="row justify-content-end">
                    <nav aria-label="...">
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">1</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="row justify-content-end tools">
                    <a href="" class="">Exportar a excel</a>
                </div>
            </div>
        </div>
        <!--- FOOTER DE CMS --->
        <div class="footer">
            <div class="container-fluid">
                <span>Samuel Rojas P.</span>
            </div>
        </div>
@stop

@section('bottom')
        @include('clientes.deletes')
@stop