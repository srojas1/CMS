@extends('layouts.default')

@section('title')
    Productos
@stop

@section('content')
    <div class="modulo container-fluid">
        <!--- CABECERA DE MÓDULO --->
        <div class="modulo-head row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-7"><h2>Productos</h2></div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-5">
                <div class="input-group">
                        <a class="btn btn-success" href="{!! URL::route('atributo.index') !!}">Mostrar Atributos</a>
                        {{--<a class="btn btn-primary" href="{!! URL::route('producto.create') !!}">Crear Producto</a>--}}
                        <button type="button" class="btn btn-primary" href="#detail_producto"
                            data-toggle="modal"
                            data-target="#detail_producto">Crear Producto</button>
                    <div class="input-group-prepend">
                        <div class="input-group-text"><i class="material-icons">search</i></div>
                    </div>
                    <input type="text" class="form-control buscador" placeholder="Buscar producto">
                </div>
            </div>
        </div>
        <!--- CONTENIDO DE MÓDULO--->
        <div class="tabpanel">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#productos">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#categorias">Categorías</a>
                </li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel"
                     class="tab-pane active" id="productos">
                    <div class="modulo-body shadow-sm border-left border-right border-button">
                        <div class="container-fluid">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col">PRODUCTO</th>
                                        <th scope="col">CATEGORIA</th>
                                        <th scope="col">STOCK</th>
                                        <th scope="col">PRECIO</th>
                                        <th scope="col">OFERTA</th>
                                        <th scope="col">VENTAS</th>
                                        <th scope="col">INGRESOS</th>
                                        <th scope="col">ACCIONES</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($producto as $prod)
                                        <tr>
                                            <th scope="row">{{$prod->producto}}</th>
                                            <td>{{$prod->getCategoryById->categoria}}</td>
                                            <td>{{getStockName($prod->id_stock)}}</td>
                                            <td>S/ {{$prod->precio}}</td>
                                            <td>S/ {{$prod->oferta}}</td>
                                            <?php $sumVentas= 0 ?>
                                            @foreach($prod->orders as $key=>$ord_prod)
                                                <?php $sumVentas+=$ord_prod->pivot->cantidad?>
                                            @endforeach
                                            <td>{{$sumVentas}}</td>
                                            <?php $ingreso=$sumVentas*$prod->precio?>
                                            <td>S/ {{$ingreso}}</td>
                                            <td>
                                                <a class="btn btn-info" href="{!! URL::route('producto.edit', array('producto' => $prod->id)) !!}"><i class="fa fa-pencil-square-o"></i></a>
                                                <a class="btn btn-danger" href="#delete_producto_{!! $prod->id !!}" data-toggle="modal" data-target="#delete_producto_{!! $prod->id !!}"><i class="fa fa-times"></i></a>&nbsp
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel"
                     class="tab-pane" id="categorias">
                    <div class="modulo-body shadow-sm border-left border-right border-button">
                        <div class="container-fluid">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col">CATEGORIA</th>
                                        <th scope="col">PRODUCTOS</th>
                                        <th scope="col">VENTAS</th>
                                        <th scope="col">INGRESOS</th>
                                        <th scope="col">ACCIONES</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($categoria as $key1=>$cat)
                                        <tr>
                                            <th scope="row">{{$cat->categoria}}</th>
                                            <?php $sumProductos = 0 ?>
                                            @foreach($cat->products as $key=>$cat)
                                                <?php $sumProductos++?>
                                            @endforeach
                                            <td>{{$sumProductos}}</td>
                                            <td>{{$cat->products}}</td></td>
                                            {{--todo: samuel desarrollar obtener cantidad de ventas--}}
                                            <td>29</td>
                                            {{--todo: samuel desarrollar obtener cantidad de ingreso--}}
                                            <td>S/ 1970.00</td>
                                            <td>
                                                <a class="btn btn-info" href="{!! URL::route('categoria.edit', array('categoria' => $cat->id)) !!}"><i class="fa fa-pencil-square-o"></i></a>
                                                <a class="btn btn-danger" href="#delete_categoria_{!! $cat->id !!}" data-toggle="modal" data-target="#delete_categoria_{!! $cat->id !!}"><i class="fa fa-times"></i></a>&nbsp
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
    {{--<div class="row">--}}
        {{--<div class="col-xs-8">--}}
            {{--<p class="lead">--}}
                {{--@if (count($producto) == 0)--}}
                    {{--No hay productos registrados por el momento--}}
                {{--@else--}}
                    {{--Lista de Productos:--}}
                {{--@endif--}}
            {{--</p>--}}
        {{--</div>--}}
        {{--<div class="col-xs-4">--}}
            {{--<div class="pull-right">--}}
                {{--<a class="btn btn-success" href="{!! URL::route('atributo.index') !!}">Mostrar Atributos</a>--}}
                {{--<a class="btn btn-primary" href="{!! URL::route('producto.create') !!}">Crear Producto</a>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    <!--- FOOTER DEL MODULO --->
    <div class="modulo-footer">
        <div class="container-fluid">
            <div class="row justify-content-end">
                <nav aria-label="...">
                    <ul class="pagination">
                        {!! $links !!}
                    </ul>
                </nav>
            </div>
            <div class="row justify-content-end tools">
                <a href="" class="">Exportar a excel</a>
            </div>
        </div>
    </div>
@stop

@section('bottom')
    @auth('edit')
        @include('productos.deletes')
    @endauth
    @include('productos.detail_create')
@stop