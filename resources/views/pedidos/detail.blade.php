@foreach ($pedido as $nkey=>$ped)
<div id="detail_pedido_{!! $ped->id !!}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
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
                <p>{{$ped->getStatusById->estado}}</p>
            </div>
            <div class="modal-body">
                <div class="tabpanel">
                    <ul class="nav nav-tabs" role="tablist">
                        <li><a href="#pedido_{!! $nkey !!}" data-toggle="tab">1. Pedido</a></li>
                        <li><a href="#entrega_{!! $nkey !!}" data-toggle="tab">2. Datos Entrega y Pago</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel"
                        class="tab-pane active" id="pedido_{!! $nkey !!}"">

                            <h4 class="modal-title">
                                Detalles del pedido
                            </h4>
                            @foreach($ped->getProductsById as $prod)
                                <p>{{$prod->producto}} - {{$prod->getCurrencyById->simbolo}} {{$prod->precio}}</p>
                            @endforeach
                            <label>Total - {{$prod->getCurrencyById->simbolo}} {{$ped->total}}</label>

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
                 <button class="btn btn-sm" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endforeach