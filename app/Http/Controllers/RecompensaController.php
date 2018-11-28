<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use GrahamCampbell\Binput\Facades\Binput;
use GrahamCampbell\BootstrapCMS\Facades\RecompensaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RecompensaController extends AbstractController {

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
		$recompensa = RecompensaRepository::paginate();

		return View::make('extras.index', ['recompensa'=>$recompensa]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('extras.recompensas.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$input = array_merge(['user_id' => Credentials::getuser()->id], Binput::only([
			'recompensa'
		]));

		$val = RecompensaRepository::validate($input, array_keys($input));

		if ($val->fails()) {
			return Redirect::route('recompensa.create')->withInput()->withErrors($val->errors());
		}

		$recompensa = RecompensaRepository::create($request->all());

		return Redirect::route('recompensa.show', ['recompensa'=>$recompensa->id])
			->with('success', trans('messages.recompensa.store_success'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @return Response
	 */
	public function show()
	{
		$recompensa = RecompensaRepository::paginate();

		return View::make('recompensa.show', ['recompensa' => $recompensa]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$recompensa = RecompensaRepository::find($id);
		$this->checkRecompensa($recompensa);

		return View::make('recompensas.edit', ['recompensa' => $recompensa]);
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
		$input = Binput::only(['recompensa']);

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
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$recompensa = RecompensaRepository::find($id);
		$this->checkRecompensa($recompensa);

		$recompensa->delete();

		return Redirect::route('recompensa.index')
			->with('success', trans('messages.recompensa.delete_success'));
	}

	/**
	 * Check the Recompensa model.
	 *
	 * @param mixed $recompensa
	 *
	 * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
	 *
	 * @return void
	 */
	protected function checkRecompensa($recompensa)
	{
		if (!$recompensa) {
			throw new NotFoundHttpException('Recompensa No Encontrada');
		}
	}
}
