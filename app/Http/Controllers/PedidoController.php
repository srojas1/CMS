<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use GrahamCampbell\BootstrapCMS\Facades\PedidoRepository;
use GrahamCampbell\BootstrapCMS\Http\Libraries\ElementLibrary;
use GrahamCampbell\BootstrapCMS\Models\Status;
use GrahamCampbell\Credentials\Credentials;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PedidoController extends AbstractController {

	/**
	 * Crear nueva instancia
	 */
	public function __construct() {
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
	 * @param Credentials $credentials
	 * @return Response
	 */
	public function index(Credentials $credentials) {

		if (!$credentials->check()) {
			return Redirect::route('account.login');
		}

		$pedido  = PedidoRepository::paginate();
		$user = $credentials->getUser();
		$userCompanyId = $credentials->getUser()->usuario_empresa_id;

		$elementLibrary = new ElementLibrary();
		$pedido = $elementLibrary->validacionEmpresaPedido($pedido,$userCompanyId);

		return View::make('pedidos.index', ['pedido' => $pedido,'user'=>$user]);
	}

	/**
	 * Cambia el estado del pedido
	 *
	 * @return Response
	 */
	public function changeStatus() {

		$id = $_POST['id_pedido'];
		$idEstado = $_POST['id_estado'];
		$labelExtra = $_POST['label_extra'];

		$pedido = PedidoRepository::find($id);
		$this->checkPedido($pedido);

		$input = ['id_estado'=>$idEstado];

		$estado = Status::find($idEstado);
		$inputEstado = ['status_label_extra'=>$labelExtra];
		if($idEstado==2) {
			$estado->update($inputEstado);
		}
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