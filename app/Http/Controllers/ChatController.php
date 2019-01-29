<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use GrahamCampbell\Credentials\Credentials;
use Illuminate\Support\Facades\View;

class ChatController extends AbstractController
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

		return View::make('chat.index', ['user'=>$user]);
	}
}
