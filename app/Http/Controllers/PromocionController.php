<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use GrahamCampbell\BootstrapCMS\Facades\CuponRepository;
use GrahamCampbell\BootstrapCMS\Facades\ProductoRepository;
use GrahamCampbell\BootstrapCMS\Facades\PromocionRepository;
use GrahamCampbell\BootstrapCMS\Facades\RecompensaRepository;
use GrahamCampbell\BootstrapCMS\Facades\ClienteRepository;
use GrahamCampbell\Credentials\Credentials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use GrahamCampbell\BootstrapCMS\Http\Libraries\ElementLibrary;

class PromocionController extends AbstractController {

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
	public function index(Credentials $credentials) {

//		if (!$credentials->check()) {
//			return Redirect::route('account.login');
//		}

		$promocion  = PromocionRepository::paginate();
		$cupon      = CuponRepository::paginate();
		$recompensa = RecompensaRepository::paginate();
		$producto   = ProductoRepository::paginate();
		$cliente    = ClienteRepository::paginate();
		$links      = PromocionRepository::links();
		$user = $credentials->getUser();
		$userCompanyId = $credentials->getUser()->usuario_empresa_id;

		$arrStatus = array(
			'promoStatus'=>'active',
			'cuponStatus'=>'',
			'recompensaStatus'=>'',
		);

		$elementLibrary = new ElementLibrary();

		$promocion = $elementLibrary->validacionEmpresa($promocion,$userCompanyId);
		$cupon = $elementLibrary->validacionEmpresa($cupon,$userCompanyId);
		$recompensa = $elementLibrary->validacionEmpresa($recompensa,$userCompanyId);

		return View::make('extras.index', [
			'promocion'=>$promocion,
			'cupon'=>$cupon,
			'recompensa'=>$recompensa,
			'links'=>$links,
			'arrStatus'=>$arrStatus,
			'extra_type'=>'Promocion',
			'extra_type_lbl'=>'promocion',
			'producto' => $producto,
			'cliente' => $cliente,
			'user'=>$user
		]);
	}

	/**
	 * Muestra el formulario para crear un nuevo recurso
	 *
	 * @return Response
	 */
	public function create() {
		return View::make('extras.promociones.create');
	}

	/**
	 * Guarda nueva promocion
	 */
	public function storePromocion(Request $request) {

		$input['promocion']    = $request->input('nombrePromocion');
		$input['precio']       = $request->input('precioPromocion');
		$input['stock_maximo'] = $request->input('stockMaximoPromocion');
		$input['fecha_inicio'] = formatStringToDateTime($request->input('lanzamientoPromocion'));
		$input['fecha_fin']    = formatStringToDateTime($request->input('fechaFinPromocion'));
		$vinculacionList       = $request->input('productoVinculadoPromo');

		//Main image
		if ($request->hasfile('imagen_principal')) {

			$images_main = $request->file('imagen_principal');
			$name_main = $images_main->getClientOriginalName();

			$images_main->move(public_path() . '/images/', $name_main);
			$data_main[] = $name_main;

			if (!empty($data_main)) {
				$input['imagen_principal'] = json_encode($data_main);
			}
		}

		//vinculacion
		if(!empty($vinculacionList)) {

			//Multiple vinculacion
			foreach($vinculacionList as $nkey=>$vinc) {
				$vincArr[]  = $vinc;
			}

			if (!empty($vincArr)) {
				$input['vinculacion_producto'] = json_encode($vincArr);
			}
		}
		$input['user_id'] = 1;
		$promocion = PromocionRepository::create($input);

		return json_encode($promocion);
	}

	/**
	 * Editar promocion.
	 */
	public function editPromocion(Request $request) {

		//Get Data
		$input['promocion']     = $request->input('nombrePromocion');
		$input['precio']        = $request->input('precioPromocion');
		$input['stock_maximo']  = $request->input('stockMaximoPromocion');
		$input['fecha_inicio']  = $request->input('lanzamientoPromocion');
		$input['fecha_fin']     = $request->input('fechaFinPromocion');
		$vinculacionList        = $request->input('productoVinculadoPromoEdit');

		$id = $request->input('id_promocion');

		//Main image
		if ($request->hasfile('imagen_principal')) {

			$images_main = $request->file('imagen_principal');
			$name_main = $images_main->getClientOriginalName();

			$images_main->move(public_path() . '/images/', $name_main);
			$data_main[] = $name_main;

			if (!empty($data_main)) {
				$input['imagen_principal'] = json_encode($data_main);
			}
		}

		if(!empty($vinculacionList)) {

			//Multiple vinculacion
			foreach($vinculacionList as $nkey=>$vinc) {
				$vincArr[]  = $vinc;
			}

			if (!empty($vincArr)) {
				$input['vinculacion_producto'] = json_encode($vincArr);
			}
		}
		else {
			$vincArr = array();
			$input['vinculacion_producto'] = json_encode($vincArr);
		}


		$promocion = PromocionRepository::find($id);

		$promocion->update($input);

		return json_encode($promocion);
	}

	/**
	 * Elimina una promoción
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		$promocion = PromocionRepository::find($id);
		$this->checkPromocion($promocion);
		
		$promocion->delete();
		
		return Redirect::route('promocion.index')
			->with('success', trans('messages.promocion.delete_success'));
	}
	
	/**
	 * Revisa el modelo de la promoción
	 *
	 * @param mixed $promocion
	 * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
	 * @return void
	 */
	protected function checkPromocion($promocion) {
		if (!$promocion) {
			throw new NotFoundHttpException('Promoción No Encontrada');
		}
	}
}