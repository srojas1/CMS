<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use GrahamCampbell\BootstrapCMS\Facades\EmpresaRepository;
use GrahamCampbell\Credentials\Credentials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;

class ConfiguracionEmpresaController extends AbstractController
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

		return View::make('conf_empresa.index', ['user'=>$user]);
	}

	/**
	 * Editar conf_empresa.
	 */
	public function editEmpresa(Request $request) {

		//Get Data
		$input['nombre_empresa']     = $request->input('nombreEmpresa');

		$id = $request->input('id_empresa');

		//Main image
		if ($request->hasfile('filename_main')) {

			$images_main = $request->file('filename_main');
			$name_main = $images_main->getClientOriginalName();

			$images_main->move(public_path() . '/images/', $name_main);
			$data_main[] = $name_main;

			if (!empty($data_main)) {
				$input['logo'] = $data_main[0];
			}
		}

		$confEmpresa = EmpresaRepository::find($id);

		$confEmpresa->update($input);

		return json_encode($confEmpresa);
	}
}
