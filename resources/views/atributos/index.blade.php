@extends('layouts.default')

@section('title')
    Atributos
@stop

@section('top')
    <div class="page-header">
        <h1>Atributos</h1>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-8">
            <p class="lead">
                @if (count($atributo) == 0)
                    No hay atributos registrados por el momento
                @else
                    Lista de Atributos:
                @endif
            </p>
        </div>
        <div class="col-xs-4">
            <div class="pull-right">
                <a class="btn btn-success" href="{!! URL::route('producto.index') !!}">Lista de Productos</a>
                <a class="btn btn-primary" href="{!! URL::route('atributo.create') !!}">Crear Atributo</a>
            </div>
        </div>
    </div>
    <hr>
    <div class="well">
        <table class="table">
            <thead>
            <th>Atributo</th>
            <th>Acciones</th>
            </thead>
            <tbody>
            @foreach ($atributo as $atr)
                <tr>
                    <td>{{$atr->atributo}}</td>
                    <td>
                        <a class="btn btn-info" href="{!! URL::route('atributo.edit', array('atributo' => $atr->id)) !!}"><i class="fa fa-pencil-square-o"></i></a>
                        <a class="btn btn-danger" href="#delete_atributo_{!! $atr->id !!}" data-toggle="modal" data-target="#delete_atributo_{!! $atr->id !!}"><i class="fa fa-times"></i></a>&nbsp
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop

@section('bottom')
    @auth('edit')
        @include('atributos.deletes')
    @endauth
@stop