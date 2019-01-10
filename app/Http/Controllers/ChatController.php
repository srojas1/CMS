<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use Illuminate\Support\Facades\View;

class ChatController extends AbstractController
{
	/**
	 * Mostrar lista del recurso
	 *
	 * @return Response
	 */
	public function index() {
		return View::make('chat.index', ['']);
	}
}
