<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use Carbon\Carbon;
use GrahamCampbell\Binput\Facades\Binput;
use GrahamCampbell\BootstrapCMS\Facades\CuponRepository;
use GrahamCampbell\BootstrapCMS\Facades\PromocionRepository;
use GrahamCampbell\BootstrapCMS\Facades\RecompensaRepository;
use GrahamCampbell\Credentials\Facades\Credentials;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CuponController extends AbstractController {

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
    $cupon = CuponRepository::paginate();
    $promocion     = PromocionRepository::paginate();
    $recompensa    = RecompensaRepository::paginate();

    $links = CuponRepository::links();

    return View::make('extras.index', [
        'promocion'=>$promocion,
        'cupon'=>$cupon,
        'recompensa'=>$recompensa,
        'links'=>$links
    ]);
}

/**
 * Show the form for creating a new resource.
 *
 * @return Response
 */
public function create()
{
    return View::make('extras.cupones.create');
}

/**
 * Store a newly created resource in storage.
 *
 * @return Response
 */
public function store()
{
    $input = array_merge(['user_id' => Credentials::getuser()->id],
        Binput::only(['cupon', 'descuento', 'vencimiento', 'stock_maximo', 'condicion',
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
 * Display the specified resource.
 *
 * @return Response
 */
public function show($id)
{
    $cupon         = CuponRepository::paginate();
    $promocion     = PromocionRepository::paginate();
    $recompensa    = RecompensaRepository::paginate();

    $links = CuponRepository::links();

    $cupon = CuponRepository::find($id);
    $this->checkCupon($cupon);

    return View::make('extras.index', [
        'promocion'=>$promocion,
        'cupon'=>$cupon,
        'recompensa'=>$recompensa,
        'links'=>$links
    ]);
}

/**
 * Show the form for editing the specified resource.
 *
 * @param  int  $id
 * @return Response
 */
public function edit($id)
{
    $cupon = CuponRepository::find($id);
    $this->checkCupon($cupon);

    return View::make('extras.cupones.edit', ['cupon' => $cupon]);
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
 * Remove the specified resource from storage.
 *
 * @param  int  $id
 * @return Response
 */
public function destroy($id)
{
    $cupon = CuponRepository::find($id);
    $this->checkCupon($cupon);

    $cupon->delete();

    return Redirect::route('cupon.index')
        ->with('success', trans('messages.cupon.delete_success'));
}

    /**
     * Check the cupon model.
     *
     * @param mixed $cupon
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return void
     */
    protected function checkCupon($cupon)
    {
        if (!$cupon) {
            throw new NotFoundHttpException('Cupon No Encontrado');
        }
    }
}
