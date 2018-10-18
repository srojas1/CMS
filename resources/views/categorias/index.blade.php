@extends('layouts.default')

@section('title')
    Categorias
@stop

@section('top')
    <div class="page-header">
        <h1>Categorias</h1>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-8">
            <p class="lead">
                @if (count($categorias) == 0)
                    No hay categorias registradas por el momento
                @else
                    Categorías:
                @endif
            </p>
        </div>
        @auth('edit')
            <div class="col-xs-4">
                <div class="pull-right">
                   <a class="btn btn-primary" href="{!! URL::route('events.create') !!}"><i class="fa fa-calendar"></i> New Event</a>
                </div>
            </div>
        @endauth
    </div>
    <hr>
    <div class="well">
        <table class="table">
            <thead>
            <th>Nombre</th>
            <th>Column2</th>
            <th>COlumn3</th>
            </thead>
            <tbody>
            @foreach ($categorias as $user)
                <tr>
                    <td>{!! $user->name !!}</td>
                    <td>{!! $user->email !!}</td>
                    <td>
                        &nbsp;<a class="btn btn-success" href="{!! URL::route('users.show', array('users' => $user->id)) !!}"><i class="fa fa-file-text"></i> Show</a>
                        @auth('admin')
                            &nbsp;<a class="btn btn-info" href="{!! URL::route('users.edit', array('users' => $user->id)) !!}"><i class="fa fa-pencil-square-o"></i> Edit</a>
                        @endauth
                        &nbsp;<a class="btn btn-warning" href="#suspend_user_{!! $user->id !!}" data-toggle="modal" data-target="#suspend_user_{!! $user->id !!}"><i class="fa fa-ban"></i> Suspend</a>
                        @auth('admin')
                            &nbsp;<a class="btn btn-default" href="#reset_user_{!! $user->id !!}" data-toggle="modal" data-target="#reset_user_{!! $user->id !!}"><i class="fa fa-lock"></i> Reset Password</a>
                            &nbsp;<a class="btn btn-danger" href="#delete_user_{!! $user->id !!}" data-toggle="modal" data-target="#delete_user_{!! $user->id !!}"><i class="fa fa-times"></i> Delete</a>
                        @endauth
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {!! $links !!}
@stop

@section('bottom')
    @auth('edit')
        @include('events.deletes')
    @endauth
@stop
