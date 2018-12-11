@foreach ($cliente as $nkey=>$cli)
<!--- MODAL USUARIOS --->
<div class="modal fade" id="detail_producto_{!! $cli->id !!}" tabindex="-1" role="dialog" aria-labelledby="detail_producto_{!! $cli->id !!}" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<!--- MODAL HEADER --->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<div class="container-fluid row col-12 align-items-center pr-0">
					<div class="container-fluid row col-12 align-items-center">
						<div class="container-fluid row col-12 justify-content-start align-items-center pb-3">
							<div class="col-12 col-md-3 col-lg-2">
								<img src="{{ asset('assets/img/producto-icon.jpg') }}" alt="..." class="fotoPerfil img-fluid border-top border-bottom border-right border-left">
							</div>
							<div class="col-12 col-md-9 col-lg-10">
								<h3 class="modal-title">{{$cli->nombres}} {{$cli->apaterno}} {{$cli->amaterno}}</h3>
								<span>nombreDeUsuario</span>
							</div>
						</div>
						<div class="container-fluid row col-12 justify-content-start align-items-center pt-4">
							<div class="col-12 col-lg-6 justify-content-start align-items-center">
								Movil: {{$cli->movil}}
							</div>
							<div class="col-12 col-lg-6 justify-content-start align-items-center">
								Correo: {{$cli->email}}
							</div>
							<div class="col-12 col-lg-6 justify-content-start align-items-center">
								Fecha nacimiento: {{$cli->fecha_nacimiento}}
							</div>
							<div class="col-12 col-lg-6 justify-content-start align-items-center">
								DNI: {{$cli->documento}}
							</div>
							<div class="col-12 col-lg-6 justify-content-start align-items-center">
								Ranking: {{$cli->ranking}}
							</div>
							<div class="col-12 col-lg-6 justify-content-start align-items-center">
								Puntos: {{$cli->puntos}}
							</div>
							<div class="col-12 col-lg-6 justify-content-start align-items-center">
								Registrado: {{$cli->created_at}}
							</div>
							<div class="col-12 col-lg-6 justify-content-start align-items-center">
								Último acceso: {{$cli->last_login}}
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="board-tabs">
					<ul class="nav nav-tabs" id="agregarProductoTAB" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="usuariosDirecciones-tab" data-toggle="tab" href="#usuariosDirecciones" role="tab" aria-controls="usuariosDirecciones" aria-selected="true">1. Direcciones</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="usuariosTarjetas-tab" data-toggle="tab" href="#usuariosTarjetas" role="tab" aria-controls="usuariosTarjetas" aria-selected="false">2. Tarjetas</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="usuariosCupones-tab" data-toggle="tab" href="#usuariosCupones" role="tab" aria-controls="usuariosCupones" aria-selected="false">3. Cupones</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="usuariosComprasYCanjes-tab" data-toggle="tab" href="#usuariosComprasYCanjes" role="tab" aria-controls="usuariosComprasYCanjes" aria-selected="false">4. Compras y canjes</a>
						</li>
					</ul>
				</div>
				<div class="tab-content" id="agregarProdcutoTABcontent">
					<div class="tab-pane fade show active" id="usuariosDirecciones" role="tabpanel" aria-labelledby="usuariosDirecciones-tab">
						<div class="board-body">
							<div class="container-fluid row">
								@foreach($cli->address as $nkey=>$adr)
									<div class="col-12 col-lg-6">
										<h4>{{$adr->getAddressType->address_type}}</h4>
										<div class="row">
											<div class="col-12">
												<div class="mapa m-0">
													<img src="{{ asset('assets/img/mapa.jpg') }}" alt="..." class="img-fluid rounded mx-auto d-block">
												</div>
											</div>
											<div class="col-12 pt-1 pb-4">
												<div>{{$adr->direccion}}<br>Referencia: {{$adr->detalles}}</div>
											</div>
										</div>
									</div>
								@endforeach
							</div>
						</div>
					</div>

					<div class="tab-pane fade show" id="usuariosTarjetas" role="tabpanel" aria-labelledby="usuariosTarjetas-tab">
						<div class="board-body">
							<div class="container-fluid row">
								@foreach($cli->getPaymentCard as $nkey=>$pay)
								<div class="col-12 col-lg-6">
									<h4>{{$pay->label}}</h4>
									<div class="container-fluid row">
										<div class="col-12 pt-1 pb-4">
											<div><strong>{{$pay->marca}} - {{$pay->nro_tarjeta}}</strong><br>{{$pay->vencimiento}} - {{$pay->cvv}}<br>{{$pay->nombre_completo}}</div>
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div>

					<div class="tab-pane fade show" id="usuariosCupones" role="tabpanel" aria-labelledby="usuariosCupones-tab">
						<div class="board-body">
							<div class="table-responsive">
								<table class="table table-hover">
									<thead class="thead-light">
									<tr>
										<th scope="col"><div class="d-flex justify-content-center">CUPÓN</div></th>
										<th scope="col"><div class="d-flex justify-content-center">DESCUENTO</div></th>
										<th scope="col"><div class="d-flex justify-content-center">VENCIMIENTO</div></th>
									</tr>
									</thead>
									<tbody>
									<tr>
										<th scope="row" class="align-middle"><div class="d-flex justify-content-center">ArribaPeru2018</div></th>
										<td class="align-middle"><div class="d-flex justify-content-center">S/ 50</div></td>
										<td class="align-middle"><div class="d-flex justify-content-center">15-feb-2021</div></td>
									</tr>
									<tr>
										<th scope="row" class="align-middle"><div class="d-flex justify-content-center">ArribaPeru2018</div></th>
										<td class="align-middle"><div class="d-flex justify-content-center">S/ 50</div></td>
										<td class="align-middle"><div class="d-flex justify-content-center">15-feb-2021</div></td>
									</tr>
									<tr>
										<th scope="row" class="align-middle"><div class="d-flex justify-content-center">ArribaPeru2018</div></th>
										<td class="align-middle"><div class="d-flex justify-content-center">S/ 50</div></td>
										<td class="align-middle"><div class="d-flex justify-content-center">15-feb-2021</div></td>
									</tr>
									<tr>
										<th scope="row" class="align-middle"><div class="d-flex justify-content-center">ArribaPeru2018</div></th>
										<td class="align-middle"><div class="d-flex justify-content-center">S/ 50</div></td>
										<td class="align-middle"><div class="d-flex justify-content-center">15-feb-2021</div></td>
									</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<div class="tab-pane fade show" id="usuariosComprasYCanjes" role="tabpanel" aria-labelledby="usuariosComprasYCanjes-tab">
						<div class="board-body">
							<div class="table-responsive">
								<table class="table table-hover">
									<thead class="thead-light">
									<tr>
										<th scope="col"><div class="d-flex justify-content-center">PEDIDO O CUPÓN</div></th>
										<th scope="col"><div class="d-flex justify-content-center">FECHA</div></th>
										<th scope="col"><div class="d-flex justify-content-center">MONTO</div></th>
										<th scope="col"><div class="d-flex justify-content-center">ESTADO</div></th>
									</tr>
									</thead>
									<tbody>
									<tr>
										<th scope="row" class="align-middle"><div class="d-flex justify-content-center">#345233452</div></th>
										<td class="align-middle"><div class="d-flex justify-content-center">20-mar-2018 17:43 </div></td>
										<td class="align-middle"><div class="d-flex justify-content-center">S/ 150</div></td>
										<td class="align-middle"><div class="d-flex justify-content-center">ENTREGADO</div></td>
									</tr>
									<tr>
										<th scope="row" class="align-middle"><div class="d-flex justify-content-center">#345233452</div></th>
										<td class="align-middle"><div class="d-flex justify-content-center">20-mar-2018 17:43 </div></td>
										<td class="align-middle"><div class="d-flex justify-content-center">S/ 150</div></td>
										<td class="align-middle"><div class="d-flex justify-content-center">ENTREGADO</div></td>
									</tr>
									<tr>
										<th scope="row" class="align-middle"><div class="d-flex justify-content-center">#345233452</div></th>
										<td class="align-middle"><div class="d-flex justify-content-center">20-mar-2018 17:43 </div></td>
										<td class="align-middle"><div class="d-flex justify-content-center">S/ 150</div></td>
										<td class="align-middle"><div class="d-flex justify-content-center">ENTREGADO</div></td>
									</tr>
									<tr>
										<th scope="row" class="align-middle"><div class="d-flex justify-content-center">#345233452</div></th>
										<td class="align-middle"><div class="d-flex justify-content-center">20-mar-2018 17:43 </div></td>
										<td class="align-middle"><div class="d-flex justify-content-center">S/ 150</div></td>
										<td class="align-middle"><div class="d-flex justify-content-center">ENTREGADO</div></td>
									</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
@endforeach