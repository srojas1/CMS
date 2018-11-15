@foreach ($pedido as $ped)
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
                <p>{{$ped->fecha_pedido}}</p>
                <p>{{$ped->getStatusById->estado}}</p>
            </div>
            <div class="modal-body">
                <div class="tabpanel">
                    <ul class="nav nav-tabs" role="tablist">
                        <li><a href="#pedido" data-toggle="tab">1. Pedido</a></li>
                        <li><a href="#entrega" data-toggle="tab">2. Datos Entrega y Pago</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel"
                        class="tab-pane active" id="pedido">

                            <h4 class="modal-title">
                                Detalles del pedido
                            </h4>
                            @foreach($ped->getProductsById as $prod)
                                <p>{{$prod->producto}} - {{$prod->precio}}</p>
                            @endforeach
                            <label>Total - {{$ped->total}}</label>

                        </div>
                        <div role="tabpanel"
                             class="tab-pane" id="entrega">
                            <h4 class="modal-title">
                                Datos de Entrega
                            </h4>
                            <p>Contacto: [Nombre Cliente]</p>
                            <p>Cel: [Movil Cliente]</p>
                            <p>[Direccion Cliente]</p>
                            <h4 class="modal-title">
                                Forma de Pago
                            </h4>
                            <p>Mastercard xxxx</p>
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