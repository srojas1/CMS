<!DOCTYPE html>
<html lang="en-GB">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>{{ Config::get('app.name') }} - @section('title')
@show</title>
@include('partials.header')
</head>
<body class="page page-principal">
<!--- BARRA DE MENU --->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <a class="navbar-brand" href="#">Cordapp</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarToggler">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <!--- en blanco por favor */--->
            </li>
        </ul>

        <!--- menu en dispositivos grandes --->
        <div class="d-none d-lg-block">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{!! URL::route('chat.index') !!}" class="nav-link"><i class="material-icons">chat</i></a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="material-icons">notifications</i></a>
                    <ul class="dropdown-menu">
                        <li class="head text-light bg-dark">
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-12 notifications_lbl">
                                    <span class="notifications_lbl">Notificaciones</span>
                                </div>
                        </li>
                        @foreach(array('1','2','3') as $nkey=>$ped)
                        <li class="notification-box">
                            <div class="row">
                                <div class="col-lg-3 col-sm-3 col-3 text-center">
                                    <img src="" class="w-50 rounded-circle">
                                </div>
                                <div class="col-lg-8 col-sm-8 col-8">
                                    <strong class="text-info">Usuario {{$nkey+1}}</strong>
                                    <div>
                                        Acaba de hacer un pedido
                                    </div>
                                    <small class="text-warning">Hace 4 minutos</small>
                                </div>
                            </div>
                        </li>
                       @endforeach
                    </ul>
                </li>
                <li class="nav-item text-hide separador">
                    |
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">account_circle</i>&nbsp;&nbsp;Usuario Administrador
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{!! URL::route('configuracion.index') !!}">Cuenta</a>
                        <a class="dropdown-item" href="{!! URL::route('account.logout') !!}">Cerrar sesión</a>
                    </div>
                </li>
            </ul>
        </div>

        <!--- menu en dispotisitivos pequeños --->
        <div class="d-lg-none">
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <a href="" class="nav-link"><i class="material-icons">chat</i></a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link"><i class="material-icons">notifications</i></a>
                </li>
                <li class="nav-item text-hide separador">
                    |
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">account_circle</i>&nbsp;&nbsp;Usuario Administrador
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Cuenta</a>
                        <a class="dropdown-item" href="#">Cerrar sesión</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container-fluid">
    <div class="page-contenedor row">
        @navigation
        <!--- CONTENIDO DEL MÓDULO SELECCIONADO --->
        <div class="container col-12 col-sm-12 col-md-9 col-lg-9 col-xl-10">
            @section('top')
            @show
            @include('partials.notifications')
            @section('content')
            @show
            @include('partials.footer')
            @section('bottom')
            @show
        </div>
</body>
</html>
