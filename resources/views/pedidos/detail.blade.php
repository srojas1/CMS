@foreach ($pedido as $nkey=>$ped)
<div id="detail_pedido_{!! $ped->id !!}" class="modal fade modalPedido" tabindex="-1" role="dialog" aria-labelledby="detail_pedido_{!! $ped->id !!}" aria-hidden="true">
    <input type="hidden" id="id_pedido" value="{{$ped->id}}"/>
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content pedido_content_{!! $ped->id  !!}">
                <!--- MODAL HEADER --->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div>
                        <h3 class="modal-title">
                            #{{$ped->id}} | {{$ped->getClientById->nombres}}
                            {{$ped->getClientById->apaterno}}
                            {{$ped->getClientById->amaterno}}
                        </h3>
                        <span>{{formatTimeText($ped->fecha_pedido)}}</span>
                        <div class="row justify-content-start align-items-center pt-4">
                            <div class="col-12">
                                <div class="btn-group">
                                    @if ($ped->getStatusById->estado)
										<?php $statusDetail = json_decode($ped->getStatusById->status_detail) ?>
                                        <button type="button" class="btn {{getColorByStatus($ped->id_estado)}} dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{$ped->getStatusById->status_label_first}} {{$ped->getStatusById->status_label_extra}}
                                        </button>
                                        <div class="detalle_aceptar dropdown-menu">
                                            @foreach($statusDetail as $nkey=>$pedetalle)
                                                <a class="dropdown-item">{{$nkey}}</a>
                                                <input id="id_status_next" type="hidden" value={{$pedetalle}}>
                                            @endforeach
                                        </div>
                                    @else
                                        <div>{{\GrahamCampbell\BootstrapCMS\Http\Constants::STATUS_EMPTY}}</div>
                                    @endif
                                </div>
                                @if($ped->id_estado != 5 && $ped->id_estado == 1)
                                    <div class="btn-group">
                                            @if ($ped->getStatusById->estado)
												<?php $statusDetailReject = json_decode($ped->getStatusById->status_reject) ?>
                                                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    {{$ped->getStatusById->status_label_second}}
                                                </button>
                                                <div class="detalle_rechazar dropdown-menu">
                                                    @foreach($statusDetailReject as $nkey=>$pedreject)
                                                        <a class="dropdown-item">{{$nkey}}</a>
                                                        <input id="id_status_next" type="hidden" value={{$pedreject}}>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div>{{\GrahamCampbell\BootstrapCMS\Http\Constants::STATUS_EMPTY}}</div>
                                            @endif
                                    </div>
                                @endif
                                <div class="btn-group">
                                    <a href="{!! URL::route('pdf_pedido.index') !!}" class="accion"><i class="material-icons print">print</i></a>
                                    <a href="{!! URL::route('pdf_pedido.create') !!}" class="accion"><hidden id="editor"></hidden><i class="material-icons download">get_app</i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="board-tabs">
                        <ul class="nav nav-tabs" id="detallePedidoTAB" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="informacionPedido-tab" data-toggle="tab" href="#informacionPedido_{!! $ped->id !!}" role="tab" aria-controls="informacionPedido" aria-selected="true">1. Información de pedido</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="datosEntrega-tab" data-toggle="tab" href="#datosEntrega_{!! $ped->id !!}" role="tab" aria-controls="datosEntrega" aria-selected="false">2. Datos de entrega</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="detallePedidoTABContent">
                        <div class="tab-pane fade show active" id="informacionPedido_{!! $ped->id !!}" role="tabpanel" aria-labelledby="informacionPedido-tab">
                            <div class="board-body">
                                <h4>Detalles de pedido</h4>
                                <div class="container-fluid">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-borderless">
                                            <tbody>
                                            <!--- LISTA DE PRODUCTOS --->
											<?php $subtotal1=0.00?>
											<?php $subtotal=0.00?>
                                            @foreach($ped->getProductsById as $nkey=>$prod)
                                                <tr>
                                                    <?php $total = count($ped->getProductsById);
                                                          $cantidad = $prod->orders[0]->pivot->cantidad/$total
                                                    ?>
                                                    <td>{{$cantidad}}</td>
                                                    <td><div class="d-inline-flex"><img class="pedido_imagen" src="{{ asset('images/'.getJsonValue($prod->imagen_principal))}}" alt="..." class="producto-icon border-top border-bottom border-right border-left">{{$prod->producto}}</div></td>
                                                    @if($prod->getMOnedaById->simbolo)
                                                        <td class="d-flex justify-content-end">{{$prod->getMOnedaById->simbolo}} {{$prod->precio}}</td>
                                                    @endif
													<?php $subtotal1 = $prod->orders[0]->pivot->cantidad*$prod->precio?>
													<?php $subtotal += $subtotal1 ?>
                                                </tr>
                                            @endforeach
                                            <!--- LISTA DE DESCUENTOS --->
                                            <tr class="border-bottom">
                                                <td></td>
                                                <td><div class="d-inline-flex"><i class="producto-icon material-icons">none</i>DESCUENTO: [Nombre descuento]</div></td>
                                                <td class="d-flex justify-content-end">- S/ 0.00</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--- RESUMEN TOTAL --->
                                    <div class="resumen table-responsive">
                                        <table class="table table-sm table-borderless">
                                            <tbody>
                                            <tr>
                                                <td><div class="d-flex justify-content-end">SUBTOTAL: </div></td>
                                                <td class="d-flex justify-content-end">S/ {{number_format($subtotal,2)}}</td>
                                            </tr>
                                            <tr>
                                                <td><div class="d-flex justify-content-end">COSTO DE ENVÍO: </div></td>
												<?php $costoEnvio = \GrahamCampbell\BootstrapCMS\Http\Constants::COSTO_ENVIO;?>
                                                <td class="d-flex justify-content-end">S/ {{number_format($costoEnvio,2)}}</td>
                                            </tr>
                                            <tr>
                                                <td><div class="d-flex justify-content-end">IGV (18%):</div></td>
												<?php  $igv = \GrahamCampbell\BootstrapCMS\Http\Constants::IGV*number_format($subtotal,2);?>
                                                <td class="d-flex justify-content-end">S/ {{number_format($igv,2)}}</td>
                                            </tr>
                                            <tr>
                                                <td><div class="d-flex justify-content-end">TOTAL:</div></td>
												<?php $extras = $costoEnvio?>
                                                <td class="d-flex justify-content-end">S/ {{number_format($subtotal+$extras,2)}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="datosEntrega_{!! $ped->id !!}" role="tabpanel" aria-labelledby="datosEntrega-tab">
                            <div class="board-body">
                                <h4>Datos de entrega</h4>
                                <div class="container-fluid">
                                    <div class="row justify-content-start align-items-center">
                                        <div class="col-6">
                                            <div class="datos">
                                                <div>Contacto: {{$ped->contacto_entrega}}</div>
                                                <div>Celular: {{$ped->movil_contacto_entrega}}</div>
                                                @if($ped->getAddressById)
                                                    <div>{{$ped->getAddressById->direccion}}</div>
                                                    <div>Referencia: {{$ped->getAddressById->detalles}}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-6 justify-content-center">
                                            <div class="mapa">
                                                <img src="{{ asset('images/mapa.jpg') }}" alt="..." class="img-fluid rounded mx-auto d-block">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mt-4">Forma de pago</h4>
                                <div class="container-fluid">
                                    <div class="row justify-content-start align-items-center">
                                        <div class="col-12">
                                            <div class="datos">
                                                @if($ped->id_forma_pago == 1)
                                                    <div><b>Forma de pago:</b> {{$ped->getFormaPago->forma_pago}}</div>
                                                    <br>
                                                    <div><b>Tipo de pago contraentrega:</b> {{$ped->getPagoContraentregaDetalle->pago_detalle}}</div>
                                                    @if($ped->getPagoContraentregaDetalle->id == 1)
                                                        <div><b>Monto efectivo:</b> S/ {{$ped->monto_efectivo}}</div>
                                                    @endif
                                                @elseif($ped->id_forma_pago == 2)
                                                    @if($ped->getPaymentCardByIdClient)
                                                        <div>{{$ped->getPaymentCardByIdClient->marca}}</div>
                                                    @else
                                                        <div>[sin marca asignada]</div>
                                                    @endif
                                                @else
                                                    <div>[sin pago asignado]</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mt-4">Comentarios del cliente</h4>
                                <div class="container-fluid">
                                    <div class="row justify-content-start align-items-center">
                                        <div class="col-12">
                                            <div class="datos">
                                                <div>Comentarios de prueba</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@section('js')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
@endsection