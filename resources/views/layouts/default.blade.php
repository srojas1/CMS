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
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <a class="navbar-brand" href="">Cordapp</a>
    <div class="collapse navbar-collapse">
    </div>
</nav>
<div class="container">
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
