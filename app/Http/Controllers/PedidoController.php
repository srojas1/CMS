<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use GrahamCampbell\BootstrapCMS\Facades\PedidoRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PedidoController extends AbstractController {

	/**
	 * Crear nueva instancia
	 */
	public function __construct()
	{
		$this->setPermissions([
			'create'  => 'edit',
			'store'   => 'edit',
			'edit'    => 'edit',
			'update'  => 'edit',
			'destroy' => 'edit',
		]);

		parent::__construct();
	}

	/**
	 * Mostrar lista del recurso
	 *
	 * @return Response
	 */
	public function index() {
		$pedido = PedidoRepository::paginate();

		return View::make('pedidos.index', ['pedido' => $pedido]);
	}

	/**
	 * Cambia el estado del pedido
	 *
	 * @return Response
	 */
	public function changeStatus() {

		$id = $_POST['id_pedido'];
		$idEstado = $_POST['id_estado'];

		$pedido = PedidoRepository::find($id);
		$this->checkPedido($pedido);

		$input = ['id_estado'=>$idEstado];

		$pedido->update($input);
	}

	/**
	 * Revisa el modelo del pedido
	 *
	 * @param $pedido
	 */
	protected function checkPedido($pedido) {
		if (!$pedido) {
			throw new NotFoundHttpException('Pedido No Encontrado');
		}
	}
}