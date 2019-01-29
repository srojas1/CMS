@extends(Config::get('credentials.layout'))

@section('title')
	<?php $__navtype = 'admin'; ?>
    Usuarios
@stop

@section('content')
    <div class="modulo container-fluid">
        <!--- MÓDULO --->
        <div class="modulo productos container-fluid">
            <!--- CABECERA DE MÓDULO --->
            <div class="board-head row pb-4">
                <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-4 pb-4">
                    <h2>Configuración de Usuarios</h2>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-2 d-flex align-items-center justify-content-end pb-4">
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 d-flex align-items-center justify-content-end pb-4">
                    {{--<div>--}}
                        {{--@auth('admin')--}}
                            {{--<a href="{!! URL::route('users.create') !!}" class="">Agregar usuario (+)</a>--}}
                        {{--@endauth--}}
                    {{--</div>--}}
                </div>
            </div>
            <!--- CONTENIDO DE MÓDULO--->
            <div class="modulo-body shadow-sm border-left border-right border-button">
                <div class="container-fluid">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col"><div class="d-flex justify-content-center">Nombre</div></th>
                                <th scope="col"><div class="d-flex justify-content-center">Empresa</div></th>
                                <th scope="col"><div class="d-flex justify-content-center">Correo</div></th>
                                <th scope="col"><div class="d-flex justify-content-center">Opciones</div></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <th scope="row" class="align-middle"><div class="d-flex align-items-center"></div>{!! $user->first_name !!}  {!! $user->last_name!!}</th>
                                    <td class="align-middle"><div class="d-flex justify-content-center">{!! $user->getEmpresaById->nombre_empresa !!}</td>
                                    <td class="align-middle"><div class="d-flex justify-content-center">{!! $user->email !!}</td>
                                    <td class="align-middle">
                                        {{--&nbsp;<a class="btn btn-success" href="{!! URL::route('users.show', array('users' => $user->id)) !!}"><i class="fa fa-file-text"></i> Show</a>--}}
                                        @auth('admin')
                                            &nbsp;<a class="btn btn-info" href="{!! URL::route('users.edit', array('users' => $user->id)) !!}"><i class="fa fa-pencil-square-o"></i> Edit</a>
                                            {{--&nbsp;<a href="{!! URL::route('users.edit', array('users' => $user->id)) !!}" class="accion">--}}
                                            {{--<i class="material-icons">edit</i>--}}
                                            {{--</a>--}}
                                        @endauth
                                        {{--&nbsp;<a class="btn btn-warning" href="#suspend_user_{!! $user->id !!}" data-toggle="modal" data-target="#suspend_user_{!! $user->id !!}"><i class="fa fa-ban"></i> Suspend</a>--}}
                                        @auth('admin')
                                            {{--&nbsp;<a class="btn btn-default" href="#reset_user_{!! $user->id !!}" data-toggle="modal" data-target="#reset_user_{!! $user->id !!}"><i class="fa fa-lock"></i> Reset Password</a>--}}
                                            &nbsp;<a class="btn btn-danger" href="#delete_user_{!! $user->id !!}" data-toggle="modal" data-target="#delete_user_{!! $user->id !!}"><i class="fa fa-times"></i> Delete</a>
                                        @endauth
                                    </td>
                                    {{--<td class="align-middle">--}}
                                    {{--<div class="d-flex justify-content-center">--}}
                                    {{--<a href="" class="accion">--}}
                                    {{--<i class="material-icons">remove_red_eye</i>--}}
                                    {{--</a>--}}
                                    {{--<a href="#modalEditarProducto_{!! $prod->id !!}" class="accion"--}}
                                    {{--data-toggle="modal"--}}
                                    {{--data-target="#modalEditarProducto_{!! $prod->id !!}">--}}
                                    {{--<i class="material-icons">edit</i>--}}
                                    {{--</a>--}}
                                    {{--<a href="#delete_producto_{!! $prod->id !!}" data-toggle="modal" data-target="#delete_producto_{!! $prod->id !!}" class="accion">--}}
                                    {{--<i class="material-icons">close</i>--}}
                                    {{--</a>--}}
                                    {{--</div>--}}
                                    {{--</td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--- FOOTER DEL MODULO --->
    <div class="modulo-footer">
        <div class="container-fluid">
            <div class="row justify-content-end">
                <nav aria-label="..." class="pagination-position">
                    <ul class="pagination">
                        {!! $links !!}
                    </ul>
                </nav>
            </div>
            <div class="row justify-content-end tools">
                {{--<a href="" class="">Exportar a excel</a>--}}
            </div>
        </div>
    </div>
    {{--<div class="row">--}}
    {{--@auth('admin')--}}
    {{--<div class="col-xs-4">--}}
    {{--<div class="pull-right">--}}
    {{--<a class="btn btn-primary" href="{!! URL::route('users.create') !!}"><i class="fa fa-user"></i> Nuevo Usuario</a>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--@endauth--}}
    {{--</div>--}}
    {{--<hr>--}}
    {{--<div class="well">--}}
    {{--<table class="table">--}}
    {{--<thead>--}}
    {{--<th>Name</th>--}}
    {{--<th>Email</th>--}}
    {{--<th>Options</th>--}}
    {{--</thead>--}}
    {{--<tbody>--}}
    {{--@foreach ($users as $user)--}}
    {{--<tr>--}}
    {{--<td>{!! $user->name !!}</td>--}}
    {{--<td>{!! $user->email !!}</td>--}}
    {{--<td>--}}
    {{--&nbsp;<a class="btn btn-success" href="{!! URL::route('users.show', array('users' => $user->id)) !!}"><i class="fa fa-file-text"></i> Show</a>--}}
    {{--@auth('admin')--}}
    {{--&nbsp;<a class="btn btn-info" href="{!! URL::route('users.edit', array('users' => $user->id)) !!}"><i class="fa fa-pencil-square-o"></i> Edit</a>--}}
    {{--@endauth--}}
    {{--&nbsp;<a class="btn btn-warning" href="#suspend_user_{!! $user->id !!}" data-toggle="modal" data-target="#suspend_user_{!! $user->id !!}"><i class="fa fa-ban"></i> Suspend</a>--}}
    {{--@auth('admin')--}}
    {{--&nbsp;<a class="btn btn-default" href="#reset_user_{!! $user->id !!}" data-toggle="modal" data-target="#reset_user_{!! $user->id !!}"><i class="fa fa-lock"></i> Reset Password</a>--}}
    {{--&nbsp;<a class="btn btn-danger" href="#delete_user_{!! $user->id !!}" data-toggle="modal" data-target="#delete_user_{!! $user->id !!}"><i class="fa fa-times"></i> Delete</a>--}}
    {{--@endauth--}}
    {{--@endauth--}}
    {{--</td>--}}
    {{--</tr>--}}
    {{--@endforeach--}}
    {{--</tbody>--}}
    {{--</table>--}}
    {{--</div>--}}
@stop

@section('bottom')
    @include('credentials::users.suspends')
    @auth('admin')
        @include('credentials::users.resets')
        @include('credentials::users.deletes')
    @endauth
@stop
