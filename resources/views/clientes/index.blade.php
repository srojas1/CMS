@extends('layouts.default')

@section('title')
    Usuarios
@stop

@section('content')
@auth('cliente')
    <div class="modulo container-fluid">
        <div class="modulo clientes container-fluid">
            <!--- CABECERA DE MÓDULO --->
            <div class="board-head row pb-4">
                <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-4 pb-4">
                    <h2>Usuarios</h2>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-2 d-flex align-items-center justify-content-end pb-4">

                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 d-flex align-items-center justify-content-end pb-4">
                    <div class="row input-group searchbox-position">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="material-icons">search</i></div>
                        </div>
                        <input type="text" class="form-control buscador" placeholder="Buscar usuario">
                    </div>
                </div>
            </div>
            <!--- CONTENIDO DE MÓDULO--->
            <div class="board-tabs">
                <ul class="nav nav-tabs" id="clientesTAB" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="usuarios-tab" data-toggle="tab" href="#usuarios" role="tab" aria-controls="usuarios" aria-selected="true">Usuarios ({{getCantidadElementos($cliente)}})</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="clientesTABContent">
                <div class="tab-pane fade show active" id="usuarios" role="tabpanel" aria-labelledby="usuarios-tab">
                    <div class="board-body shadow-sm border-left border-right border-bottom">
                        <div class="container-fluid">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                    <tr>
                                        <th scope="col"><div class="d-flex justify-content-center">USUARIO</div></th>
                                        <th scope="col"><div class="d-flex justify-content-center">DISTRITO</div></th>
                                        <th scope="col"><div class="d-flex justify-content-center">RANKING</div></th>
                                        <th scope="col"><div class="d-flex justify-content-center">PUNTOS</div></th>
                                        <th scope="col"><div class="d-flex justify-content-center">ÚLTIMO ACCESO</div></th>
                                        <th scope="col"><div class="d-flex justify-content-center">ÚLTIMA COMPRA</div></th>
                                        <th scope="col"><div class="d-flex justify-content-center">TOTAL PEDIDOS</div></th>
                                        <th scope="col"><div class="d-flex justify-content-center">TOTAL COMPRAS</div></th>
                                        <th scope="col"><div class="d-flex justify-content-center">ACCIONES</div></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cliente as $cli)
                                            <tr>
                                                <th scope="row" class="align-middle"><div class="d-flex align-items-center"><img src="{{ asset('images/producto-icon.jpg') }}" alt="..." class="thumbnail border-top border-bottom border-right border-left"><div>{{$cli->nombres}} {{$cli->apaterno}} {{$cli->amaterno}} (30)<small class="d-flex justify-content-start">{{$cli->email}} / {{$cli->movil}}</small></div></div></th>
                                                <td class="align-middle"><div class="d-flex justify-content-center">{{$cli->address[0]->getDistrict->distrito}}</div></td>
                                                <td class="align-middle"><div class="d-flex justify-content-center">#{{$cli->ranking}}</div></td>
                                                <td class="align-middle"><div class="d-flex justify-content-center">{{$cli->puntos}}</div></td>
                                                <td class="align-middle"><div class="d-flex justify-content-center">{{$cli->last_login}}</div></td>
                                                @if($cli->lastOrder)
                                                    <td class="align-middle"><div class="d-flex justify-content-center">{{$cli->lastOrder->fecha_compra}}</div></td>
                                                @endif
                                                <?php $sumPedidos = 0 ?>
                                                @foreach($cli->orders as $key=>$ord)
                                                    <?php $sumPedidos ++?>
                                                @endforeach
                                                <td class="align-middle"><div class="d-flex justify-content-center">{{$sumPedidos}}</td>
                                                <?php $sumTotales = 0 ?>
                                                @foreach($cli->orders as $key=>$ord)
                                                    <?php $sumTotales += $ord->total?>
                                                @endforeach
                                                <td class="align-middle"><div class="d-flex justify-content-center">S/ {{number_format($sumTotales,2)}}</div></td>
                                                <td class="align-middle"><div class="d-flex justify-content-center">
                                                        <a href="#detail_producto_{!! $cli->id !!}" class="accion"   data-toggle="modal"
                                                           data-target="#detail_producto_{!! $cli->id !!}">
                                                            <i class="material-icons">edit</i>
                                                        </a>
                                                        <a href="#delete_cliente_{!! $cli->id !!}" data-toggle="modal" data-target="#delete_cliente_{!! $cli->id !!}" data-toggle="modal" data-target="#delete_cliente_{!! $cli->id !!}" class="accion">
                                                            <i class="material-icons">close</i>
                                                        </a>
                                                    </div>
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
            <!--- FOOTER DE CMS --->
            <div class="footer">
                <div class="container-fluid">
                    <span>@Copyright</span>
                </div>
            </div>
        </div>
@endauth
@stop

@section('bottom')
    @include('clientes.deletes')
    @include('clientes.detail')
@stop
@section('js')
    <script type="text/javascript" src="{{ asset('assets/scripts/clientes.js')}}"></script>
@endsection