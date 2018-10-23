@extends('layouts.default')

@section('title')
    Categorias
@stop

@section('top')
    <div class="page-header">
        <h1>Categorías</h1>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-8">
            <p class="lead">
                @if (count($categoria) == 0)
                    No hay categorias registradas por el momento
                @else
                    Lista de Categorías:
                @endif
            </p>
        </div>
            <div class="col-xs-4">
                <div class="pull-right">
                    <a class="btn btn-primary" href="{!! URL::route('users.create') !!}">Crear Categoría</a>
                </div>
            </div>
    </div>
    <hr>
    <div class="well">
        <table class="table">
            <thead>
            <th>Categoría</th>
            <th>Productos</th>
            <th>Ventas</th>
            <th>Ingresos</th>
            <th>Acciones</th>
            </thead>
            <tbody>
            @foreach ($categoria as $cat)
                <tr>
                    <td>{{$cat->categoria}}</td>
                    <td>4</td>
                    <td>4</td>
                    <td>29.192</td>
                    <td>
                        <a class="btn btn-info" href=""><i class="fa fa-pencil-square-o"></i></a>
                        <a class="btn btn-danger" href=""><i class="fa fa-times"></i></a>&nbsp;
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop