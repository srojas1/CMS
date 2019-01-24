<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use GrahamCampbell\BootstrapCMS\Facades\ClienteRepository;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ClienteController extends AbstractController {

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
	 * @return Response
	 */
	public function index() {
		$cliente   = ClienteRepository::paginate();
		$links     = ClienteRepository::links();

		$links = formatPagination($links);

		return View::make('clientes.index',
			[
			'cliente' => $cliente,
			'links'=>$links,
			]
		);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$cliente = ClienteRepository::find($id);
		$this->checkClient($cliente);

		$cliente->delete();

		return Redirect::route('cliente.index')
			->with('success', trans('messages.cliente.delete_success'));
	}

	/**
	 * Check the client model.
	 *
	 * @param mixed $client
	 * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
	 * @return void
	 */
	protected function checkClient($client)
	{
		if (!$client) {
			throw new NotFoundHttpException('Cliente No Encontrado');
		}
	}
	}
