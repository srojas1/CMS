<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use Illuminate\Support\Facades\View;

class DashboardController extends AbstractController
{
	/**
	 * Mostrar lista del recurso
	 *
	 * @return Response
	 */
	public function index() {
		return View::make('dashboard.index', ['']);
	}
}
