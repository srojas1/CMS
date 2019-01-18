<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use Carbon\Carbon;
use GrahamCampbell\Binput\Facades\Binput;
use GrahamCampbell\BootstrapCMS\Facades\CuponRepository;
use GrahamCampbell\BootstrapCMS\Facades\PromocionRepository;
use GrahamCampbell\BootstrapCMS\Facades\RecompensaRepository;
use GrahamCampbell\BootstrapCMS\Facades\CuponClienteRepository;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Request;

class CuponController extends AbstractController {

	/**
	 * Crear nueva instancia
	 */
	public function __construct()
	{
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
	public function index()
	{
		$cupon         = CuponRepository::paginate();
		$promocion     = PromocionRepository::paginate();
		$recompensa    = RecompensaRepository::paginate();

		$links = CuponRepository::links();

		$arrStatus = array(
			'promoStatus'=>'',
			'cuponStatus'=>'active',
			'recompensaStatus'=>'',
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
	 * Muestra el formulario para crear un nuevo recurso
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('extras.cupones.create');
	}

	/**
	 * Guarda nuevo cupon
	 */
	public function storeCupon(Request $request) {

		$input['cupon']    = $request->input('nombreCupon');
		$input['descuento']       = $request->input('descuentoCupon');
		$input['vencimiento'] = formatStringToDateTime($request->input('vencimientoCupon'));
		$input['stock_maximo'] = $request->input('stockMaximoCupon');
		$input['condicion']    = $request->input('condicionPromocion');

		$cupon = CuponRepository::create($input);

		$vinculacionCliente  = $request->input('clienteVinculadoCupon');

		if(!empty($vinculacionCliente)) {

			//Multiple clients
			foreach($vinculacionCliente as $nkey=>$vinCli) {
				$inputCli['client_id']   = $vinCli;
				$inputCli['cupon_id']    = $cupon->id;

				CuponClienteRepository::create($inputCli);
			}
		}

		return json_encode($cupon);
	}

	/**
	 * Edita cupon
	 */
	public function editCupon(Request $request) {

		//Get Data
		$input['cupon']         = $request->input('nombreCupon');
		$input['descuento']     = $request->input('descuentoCupon');
		$input['vencimiento']   = $request->input('vencimientoCupon');
		$input['stock_maximo']  = $request->input('stockMaximoCupon');
		$input['condicion']     = $request->input('condicionPromocion');

		$id = $request->input('id_cupon');

		$cupon = CuponRepository::find($id);

		$cupon->update($input);

		return json_encode($cupon);
	}

	/**
	 * Graba un nuevo recurso
	 *
	 * @return Response
	 */
	public function store() {
		$input = array_merge(Binput::only(['cupon', 'descuento', 'vencimiento', 'stock_maximo', 'condicion',
		]));

		$val = CuponRepository::validate($input, array_keys($input));

		if ($val->fails()) {
			return Redirect::route('cupon.create')->withInput()->withErrors($val->errors());
		}

		$input['vencimiento'] = Carbon::createFromFormat(Config::get('date.php_format'), $input['vencimiento']);

		$cupon = CuponRepository::create($input);

		return Redirect::route('cupon.show', ['cupon'=>$cupon->id])
			->with('success', trans('messages.cupon.store_success'));
	}

	/**
	 * Muestra el recurso específico
	 *
	 * @return Response
	 */
	public function show($id) {
		$cupon         = CuponRepository::paginate();
		$promocion     = PromocionRepository::paginate();
		$recompensa    = RecompensaRepository::paginate();

		$links = CuponRepository::links();

		$this->checkCupon($cupon);

		$arrStatus = array(
			'promoStatus'=>'',
			'cuponStatus'=>'active',
			'recompensaStatus'=>'',
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
	 * Muestra el formulario de edición del recurso
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$cupon = CuponRepository::find($id);
		$this->checkCupon($cupon);

		return View::make('extras.cupones.edit', ['cupon' => $cupon]);
	}

	/**
	 * Actualiza el recurso específico
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$input = Binput::only(['cupon', 'descuento', 'vencimiento', 'stock_maximo', 'condicion']);

		$val = $val = CuponRepository::validate($input, array_keys($input));
		if ($val->fails()) {
			return Redirect::route('cupon.edit', ['cupon' => $id])->withInput()->withErrors($val->errors());
		}

		$input['vencimiento'] = Carbon::createFromFormat(Config::get('date.php_format'), $input['vencimiento']);

		$cupon = CuponRepository::find($id);
		$this->checkCupon($cupon);

		$cupon->update($input);

		return Redirect::route('cupon.show', ['cupon' => $cupon->id])
			->with('success', trans('messages.cupon.update_success'));
	}

	/**
	 * Remueve el recurso
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		$cupon = CuponRepository::find($id);
		$this->checkCupon($cupon);

		$cupon->delete();
		
		return Redirect::route('promocion.index')
			->with('success', trans('messages.cupon.delete_success'));
	}

	/**
	 * Revisa el modelo del cupón
	 *
	 * @param mixed $cupon
	 * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
	 * @return void
	 */
	protected function checkCupon($cupon) {
		if (!$cupon) {
			throw new NotFoundHttpException('Cupon No Encontrado');
		}
	}
}
