<!DOCTYPE html>
<html lang="en-GB">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>{{ Config::get('app.name') }} - @section('title')
@show</title>
@include('partials.header')
</head>
<body>
@navigation
<div class="container">
    <div class="page-contenedor row">
        <!--- PANEL LATERAL IZQUIERDA --->
        <div class="panel-modulos col-12 col-sm-12 col-md-3 col-lg-3 col-xl-2">
            <div class="logo-tienda">
                <h1 class="text-hide" style="background-image: url('https://getbootstrap.com/docs/4.1/assets/brand/bootstrap-solid.svg'); max-width: 320px; height: 50px; background-repeat: no-repeat;">Logo tienda</h1>
            </div>
            <div class="modulos">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="material-icons">dashboard</i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="material-icons">assignment</i> Pedidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="material-icons">store</i> Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="material-icons">card_giftcard</i> Promociones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="material-icons">group</i> Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#"><i class="material-icons">phonelink_setup</i> Personaliza tu app</a>
                    </li>
                </ul>
            </div>
        </div>
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
