<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use Illuminate\Support\Facades\View;

class BienvenidoController extends AbstractController
{
	/**
	 * Mostrar lista del recurso
	 *
	 * @return Response
	 */
	public function index() {
		return View::make('bienvenido.index', ['']);
	}
}
