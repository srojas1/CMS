<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use GrahamCampbell\Binput\Facades\Binput;
use GrahamCampbell\BootstrapCMS\Facades\RecompensaRepository;
use GrahamCampbell\BootstrapCMS\Facades\CuponRepository;
use GrahamCampbell\BootstrapCMS\Facades\PromocionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RecompensaController extends AbstractController {

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
	public function index() {
		$recompensa = RecompensaRepository::paginate();
		$links = RecompensaRepository::links();

		$arrStatus = array(
			'promoStatus'=>'',
			'cuponStatus'=>'',
			'recompensaStatus'=>'active',
		);

		return View::make('extras.index', ['recompensa'=>$recompensa,'links'=>$links,'arrStatus'=>$arrStatus,]);
	}

	/**
	 * Muestra el formulario para crear un nuevo recurso
	 *
	 * @return Response
	 */
	public function create() {
		return View::make('extras.recompensas.create');
	}

	/**
	 * Guarda nueva recompensa
	 */
	public function storeRecompensa(Request $request) {

		$input['recompensa']    = $request->input('nombreRecompensa');
		$input['evento']        = $request->input('eventoRecompensa');
		$input['puntos']        = $request->input('puntosRecompensa');
		$input['descripcion']   = $request->input('descripcionRecompensa');

		$recompensa = RecompensaRepository::create($input);

		return json_encode($recompensa);
	}

	/**
	 * Editar recompensa
	 */
	public function editRecompensa(Request $request) {

		//Get Data
		$input['recompensa']    = $request->input('nombreRecompensa');
		$input['evento']        = $request->input('eventoRecompensa');
		$input['puntos']        = $request->input('puntosRecompensa');
		$input['descripcion']   = $request->input('descripcionRecompensa');

		$id = $request->input('id_recompensa');

		$recompensa = RecompensaRepository::find($id);

		$recompensa->update($input);

		return json_encode($recompensa);
	}


	/**
	 * Graba un nuevo recurso
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function store() {
		$input = array_merge(Binput::only([
			'recompensa',
			'puntos',
			'descripcion'
		]));

		$val = RecompensaRepository::validate($input, array_keys($input));

		if ($val->fails()) {
			return Redirect::route('recompensa.create')->withInput()->withErrors($val->errors());
		}

		$recompensa = RecompensaRepository::create($input);

		return Redirect::route('recompensa.show', ['recompensa'=>$recompensa->id])
			->with('success', trans('messages.recompensa.store_success'));
	}

	/**
	 * Muestra el recurso específico
	 *
	 * @return Response
	 */
	public function show() {
		$cupon         = CuponRepository::paginate();
		$promocion     = PromocionRepository::paginate();
		$recompensa    = RecompensaRepository::paginate();

		$links = RecompensaRepository::links();

		$this->checkRecompensa($recompensa);

		$arrStatus = array(
			'promoStatus'=>'',
			'cuponStatus'=>'',
			'recompensaStatus'=>'active',
		);

		return View::make('extras.index', [
			'promocion'=>$promocion,
			'cupon'=>$cupon,
			'recompensa'=>$recompensa,
			'links'=>$links,
			'arrStatus'=>$arrStatus,
		]);
	}

	/**
	 * Muestra el formulario para editar el recurso
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$recompensa = RecompensaRepository::find($id);
		$this->checkRecompensa($recompensa);

		return View::make('extras.recompensas.edit', ['recompensa' => $recompensa]);
	}

	/**
	 * Actualiza el recurso específico
	 *
	 * @param  Request  $request
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$input = Binput::only(['recompensa','puntos','descripcion']);

		$val = $val = RecompensaRepository::validate($input, array_keys($input));
		if ($val->fails()) {
			return Redirect::route('Recompensa.edit', ['recompensa' => $id])->withInput()->withErrors($val->errors());
		}

		$recompensa = RecompensaRepository::find($id);
		$this->checkRecompensa($recompensa);

		$recompensa->update($input);

		return Redirect::route('recompensa.show', ['recompensa' => $recompensa->id])
			->with('success', trans('messages.Recompensa.update_success'));
	}

	/**
	 * Remueve el recurso específico
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		$recompensa = RecompensaRepository::find($id);
		$this->checkRecompensa($recompensa);

		$recompensa->delete();

		return Redirect::route('promocion.index')
			->with('success', trans('messages.recompensa.delete_success'));
	}

	/**
	 * Revisa el modelo de recompensa
	 *
	 * @param mixed $recompensa
	 * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
	 * @return void
	 */
	protected function checkRecompensa($recompensa) {
		if (!$recompensa) {
			throw new NotFoundHttpException('Recompensa No Encontrada');
		}
	}
}
