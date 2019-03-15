<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use GrahamCampbell\BootstrapCMS\Models\Empresa;
use GrahamCampbell\Credentials\Credentials;

class BienvenidoController extends AbstractController {

	/**
	 * Mostrar lista del recurso
	 *
	 * @return Response
	 */
	public function index(Credentials $credentials) {

		if (!$credentials->check()) {
			return Redirect::route('account.login');
		}

		$empresa = Empresa::first();

		return View::make('bienvenido.index', ['empresa'=>$empresa]);
	}
}
