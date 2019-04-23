<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use GrahamCampbell\BootstrapCMS\Facades\PedidoRepository;
use GrahamCampbell\Credentials\Credentials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\App;
use GrahamCampbell\BootstrapCMS\Http\Libraries\ElementLibrary;

class PdfController extends AbstractController {

	public function index(Credentials $credentials) {

		$pedido = PedidoRepository::paginate();
		$user = $credentials->getUser();
		$userCompanyId = $user->usuario_empresa_id;

		$elementLibrary = new ElementLibrary();
		$pedido = $elementLibrary->validacionEmpresaPedido($pedido,$userCompanyId);

		$view =  View::make('pdf_pedido.index', ['pedido'=>$pedido])->render();
		$pdf = App::make('dompdf.wrapper');
		$pdf->loadHTML($view);
		return $pdf->stream('print');
	}

	public function create(Credentials $credentials) {
		$pedido = PedidoRepository::paginate();

		$user = $credentials->getUser();
		$userCompanyId = $user->usuario_empresa_id;

		$elementLibrary = new ElementLibrary();
		$pedido = $elementLibrary->validacionEmpresaPedido($pedido,$userCompanyId);

		$view =  View::make('pdf_pedido.index', ['pedido'=>$pedido])->render();
		$pdf = App::make('dompdf.wrapper');
		$pdf->loadHTML($view);
		return $pdf->download('download');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}
}