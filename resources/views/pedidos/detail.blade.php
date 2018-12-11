@foreach ($pedido as $nkey=>$ped)
<div id="detail_pedido_{!! $ped->id !!}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <input type="hidden" id="id_pedido" value="{{$ped->id}}"/>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">
                    #{{$ped->id}} | {{$ped->getClientById->nombres}}
                    {{$ped->getClientById->apaterno}}
                    {{$ped->getClientById->amaterno}}
                </h4>
            </div>
            <div class="modal-body">
                <p>{{formatTimeText($ped->fecha_pedido)}}</p>
                @if ($ped->getStatusById->estado)
                    <select class="form-control m-bot15" id="id_estado_change">
                        {{--todo: poner estados desde la bd--}}
                            @foreach(array('1'=>'NO ATENDIDO',
                                           '2'=>'PROCESADO',
                                           '3'=>'ENTREGADO',
                                           '4'=>'FALLIDO',
                                           '5'=>'RECHAZADO') as $key => $est)
                                    <option value={{$key}}> {{$est}}</option>
                            @endforeach
                    </select>
                @else
                    <td>{{\GrahamCampbell\BootstrapCMS\Http\Constants::STATUS_EMPTY}}</td>
                @endif
            </div>
            <div class="modal-body">
                <div class="tabpanel">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#pedido_{!! $nkey !!}" data-toggle="tab">1. Pedido</a></li>
                        <li><a href="#entrega_{!! $nkey !!}" data-toggle="tab">2. Datos Entrega y Pago</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel"
                        class="tab-pane active" id="pedido_{!! $nkey !!}">

                            <h4 class="modal-title">
                                Detalles del pedido
                            </h4>
                            @foreach($ped->getProductsById as $prod)

                                <p>{{$prod->producto}} -
                                    @if($prod->getCurrencyById->simbolo)
                                        {{$prod->getCurrencyById->simbolo}}
                                    @endif
                                {{$prod->precio}}</p>
                            @endforeach
                                <label>Total - S/ {{$ped->total}}</label>
                        </div>
                        <div role="tabpanel"
                             class="tab-pane" id="entrega_{!! $nkey !!}"">

                            <h4 class="modal-title">
                                Datos de Entrega
                            </h4>
                            <p>Contacto: {{$ped->contacto_entrega}}</p>
                            <p>Cel: {{$ped->movil_contacto_entrega}}</p>
                            @if($ped->getAddressById)
                                <p>{{$ped->getAddressById->direccion}} {{$ped->getAddressById->detalles}}</p>
                            @endif
                            <h4 class="modal-title">
                                Forma de Pago
                            </h4>
                            <p>
                                {{$ped->getPaymentCardByIdClient->marca}} -
                                {{$ped->getPaymentCardByIdClient->nro_tarjeta}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                 <button class="btn btn-sm close_modal" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@section('js')
<script type="text/javascript" src="{{ asset('assets/scripts/pedidos.js')}}"></script>
@endsection