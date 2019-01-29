@extends('layouts.default')

@section('title')
	Editar Privilegios: {{$user->name}}
@stop
@section('content')
	<div class="modulo container-fluid">
		<div class="modulo clientes container-fluid">
			<!--- CABECERA DE MÓDULO --->
			<div class="board-head row pb-4">
				<div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-4 pb-4">
					<h2>Editar Privilegios</h2>
				</div>
				<div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-2 d-flex align-items-center justify-content-end pb-4">

				</div>
			</div>
			<!--- CONTENIDO DE MÓDULO--->
			<div class="tab-content" id="clientesTABContent">
				<div class="tab-pane fade show active" id="usuarios" role="tabpanel" aria-labelledby="usuarios-tab">
					<div class="board-body shadow-sm border-left border-right border-bottom">
						<div class="container-fluid">
							<div class="table-responsive">
								<div>
									<input type="checkbox" name='dashboard'> Dashboard
								</div>
								<div>
									<input type="checkbox" name='pedido'> Pedidos
								</div>
								<div>
									<input type="checkbox" name='producto'> Productos
								</div>
								<div>
									<input type="checkbox" name='promocion'> Promociones
								</div>
								<div>
									<input type="checkbox" name='cupon'> Cupones
								</div>
								<div>
									<input type="checkbox" name='recompensa'> Recompensas
								</div>
								<div>
									<input type="checkbox" name='cliente'> Usuarios (Clientes)
								</div>
								<div>
									<input type="checkbox" name='personaliza'> Personaliza App
								</div>
								<div>
									<input type="checkbox" name='cliente'> Clientes
								</div>
								<div>
									<input type="checkbox" name='chat'> Chats
								</div>
							</div>
						</div>
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
@stop