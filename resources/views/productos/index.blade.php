@extends('layouts.default')

@section('title')
    Productos
@stop

@section('top')
    <div class="page-header">
        <h1>Producto</h1>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-8">
            <p class="lead">
                @if (count($producto) == 0)
                    No hay productos registradas por el momento
                @else
                    Lista de Productos:
                @endif
            </p>
        </div>
        <div class="col-xs-4">
            <div class="pull-right">
                <a class="btn btn-primary" href="{!! URL::route('producto.create') !!}">Crear Producto</a>
            </div>
        </div>
    </div>
    <hr>
    <div class="well">
        <table class="table">
            <thead>
            <th>Producto</th>
            <th>Categoria</th>
            <th>Stock</th>
            <th>Precio</th>
            <th>Oferta</th>
            </thead>
            <tbody>
            @foreach ($producto as $prod)
                <tr>
                    <td>{{$prod->producto}}</td>
                    <td>Con Alcohol</td>
                    <td>2</td>
                    <td>29.00</td>
                    <td>29.00</td>
                    <td>
                        <a class="btn btn-info" href=""><i class="fa fa-pencil-square-o"></i></a>
                        <a class="btn btn-danger" href=""><i class="fa fa-times"></i></a>&nbsp
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop