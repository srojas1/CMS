<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use GrahamCampbell\BootstrapCMS\Models\Empresa;
use Illuminate\Support\Facades\View;

class BienvenidoController extends AbstractController {
	/**
	 * Mostrar lista del recurso
	 *
	 * @return Response
	 */
	public function index() {

		$empresa = Empresa::first();

		return View::make('bienvenido.index', ['empresa'=>$empresa]);
	}
}
