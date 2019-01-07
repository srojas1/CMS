<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use GrahamCampbell\BootstrapCMS\Facades\CuponRepository;
use GrahamCampbell\BootstrapCMS\Facades\PromocionRepository;
use GrahamCampbell\BootstrapCMS\Facades\RecompensaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PromocionController extends AbstractController {

	/**
	 * Create a new instance.
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
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function index()
	{
		$promocion  = PromocionRepository::paginate();
		$cupon      = CuponRepository::paginate();
		$recompensa = RecompensaRepository::paginate();

		$links = PromocionRepository::links();

		$arrStatus = array(
			'promoStatus'=>'active',
			'cuponStatus'=>'',
			'recompensaStatus'=>'',
		);

		return View::make('extras.index', [
			'promocion'=>$promocion,
			'cupon'=>$cupon,
			'recompensa'=>$recompensa,
			'links'=>$links,
			'arrStatus'=>$arrStatus,
			'extra_type'=>'Promocion',
			'extra_type_lbl'=>'promocion',
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
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

		$id = $request->input('id_promocion');

		$promocion = PromocionRepository::find($id);

		$promocion->update($input);

		return json_encode($promocion);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function show()
	{
	   //
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Request  $request
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		//
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$promocion = PromocionRepository::find($id);
		$this->checkPromocion($promocion);
		
		$promocion->delete();
		
		return Redirect::route('promocion.index')
			->with('success', trans('messages.promocion.delete_success'));
	}
	
	/**
	 * Check the promocion model.
	 *
	 * @param mixed $promocion
	 *
	 * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
	 *
	 * @return void
	 */
	protected function checkPromocion($promocion)
	{
		if (!$promocion) {
			throw new NotFoundHttpException('Promoción No Encontrada');
		}
	}
}