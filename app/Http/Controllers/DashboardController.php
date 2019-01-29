<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use GrahamCampbell\Credentials\Credentials;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class DashboardController extends AbstractController
{
	/**
	 * Mostrar lista del recurso
	 *
	 * @return Response
	 */
	public function index(Credentials $credentials) {

		if (!$credentials->check()) {
			return Redirect::route('account.login');
		}

		$user = $credentials->getUser();

		return View::make('dashboard.index', ['user'=>$user]);
	}
}
