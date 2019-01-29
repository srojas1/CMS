<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use GrahamCampbell\BootstrapCMS\Facades\ClienteRepository;
use GrahamCampbell\Credentials\Credentials;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use GrahamCampbell\BootstrapCMS\Http\Libraries\ElementLibrary;

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
	public function index(Credentials $credentials) {

		if (!$credentials->check()) {
			return Redirect::route('account.login');
		}

		$cliente   = ClienteRepository::paginate();
		$links     = ClienteRepository::links();
		$links     = formatPagination($links);
		$user = $credentials->getUser();
		$userCompanyId = $credentials->getUser()->user_company_id;

		$elementLibrary = new ElementLibrary();

		$cliente = $elementLibrary->validacionEmpresa($cliente,$userCompanyId);

		return View::make('clientes.index',
			[
			'cliente' => $cliente,
			'links'=>$links,
			'user'=>$user
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
