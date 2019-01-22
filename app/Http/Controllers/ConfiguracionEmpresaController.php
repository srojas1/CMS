<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use GrahamCampbell\BootstrapCMS\Models\Empresa as Empresa;
use Illuminate\Support\Facades\View;

class ConfiguracionEmpresaController extends AbstractController
{
	/**
	 * Mostrar lista del recurso
	 *
	 * @return Response
	 */
	public function index() {
		$empresa  = Empresa::first();
		return View::make('conf_empresa.index', ['empresa'=>$empresa]);
	}
}
