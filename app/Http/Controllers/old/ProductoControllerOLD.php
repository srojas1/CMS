<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use GrahamCampbell\Binput\Facades\Binput;
use GrahamCampbell\BootstrapCMS\Facades\AtributoRepository;
use GrahamCampbell\BootstrapCMS\Facades\AtributoProductoRepository;
use GrahamCampbell\BootstrapCMS\Facades\ProductoRepository;
use GrahamCampbell\BootstrapCMS\Facades\CategoriaRepository;
use GrahamCampbell\BootstrapCMS\Models\Producto;
use GrahamCampbell\Credentials\Credentials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use GrahamCampbell\BootstrapCMS\Http\Constants as Config;
use GrahamCampbell\BootstrapCMS\Http\Libraries\ElementLibrary;

class ProductoController extends AbstractController
{
	/**
	 * Crear nueva instancia
	 *
	 * @return void
	 */
	public function __construct() {

		$this->setPermissions([
			'create'  => 'edit',
			'store'   => 'edit',
			'store1'  => 'edit',
			'edit'    => 'edit',
			'update'  => 'edit',
			'destroy' => 'edit',
		]);

		$this->producto = Producto::with('getCategoryById')->get();

		parent::__construct();

	}

	/**
	 * Display a listing of products.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index(Credentials $credentials) {

//		if (!$credentials->check()) {
//			return Redirect::route('account.login');
//		}

		$producto  = ProductoRepository::all();
		$links     = ProductoRepository::links();
		$categoria = CategoriaRepository::all();
		$linksCat  = CategoriaRepository::links();
		$atributos = AtributoRepository::all();
		$user = $credentials->getUser();
		$userCompanyId = $credentials->getUser()->usuario_empresa_id;

		$stockName = array(
			array('nombre'=>Config::EN_STOCK_LABEL,'value'=>Config::EN_STOCK),
			array('nombre'=>Config::AGOTADO_LABEL,'value'=>Config::AGOTADO),
			array('nombre'=>Config::PRONTO_LABEL,'value'=>Config::PRONTO)
		);

		$links = formatPagination($links);
		$linksCat = formatPagination($linksCat);

		$elementLibrary = new ElementLibrary();

		$producto  = $elementLibrary->validacionEmpresa($producto,$userCompanyId);
		$categoria = $elementLibrary->validacionEmpresa($categoria,$userCompanyId);

		return View::make('productos.index',
			[
				'producto' => $producto,
				'links'=>$links,
				'categoria'=>$categoria,
				'linksCat'=>$linksCat,
				'stock' => $stockName,
				'atributos'=>$atributos,
				'user'=>$user
			]);
	}

	/**
	 * Muestra el formulario para crear un nuevo recurso
	 *
	 * @return Response
	 */
	public function create() {
		$categorias = CategoriaRepository::all();
		$atributos  = AtributoRepository::all();

		$stockName = array(
			array('nombre'=>Config::EN_STOCK_LABEL,'value'=>Config::EN_STOCK),
			array('nombre'=>Config::AGOTADO_LABEL,'value'=>Config::AGOTADO),
			array('nombre'=>Config::PRONTO_LABEL,'value'=>Config::PRONTO)
		);

		return View::make('productos.create',[
			'categorias' => $categorias,
			'stock' => $stockName,
			'atributos'=>$atributos
		]);
	}

	/**
	 * Obtiene valores del input
	 *
	 * @return array
	 */
	protected function getInput() {
		return [
			'producto'     => Binput::get('nombreProducto'),
			'codigo'       => Binput::get('codigoProducto'),
			'descripcion'  => Binput::get('descripcionProducto'),
			'id_categoria' => Binput::get('selectCategorias'),
			'id_stock'     => Binput::get('stockValue'),
			'sku'          => Binput::get('sku'),
			'precio'       => Binput::get('precio'),
			'oferta'       => Binput::get('oferta'),
			'visibilidad'  => Binput::get('visibilidad')
		];
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function store(Request $request) {
		$input = array_merge(
			$this->getInput()
		);


		$val = ProductoRepository::validate($input, array_keys($input));

		if ($val->fails()) {
			return Redirect::route('producto.create')->withInput()->withErrors($val->errors());
		}

		$atributos = $request->input('valor');
		$idAtributo = $request->input('id_atributo');

		foreach ($atributos as $key => $atr) {
			$arr['valor'] = $atr;
		}

		if ($request->hasfile('filename')) {
			$images = $request->file('filename');

			foreach ($images as $key => $image) {
				if (!empty($image)) {
					$name = $image->getClientOriginalName();
					$image->move(public_path() . '/images/', $name);
					$data[] = $name;
				} else {
					continue;
				}
			}
		}

		if (!empty($data)) {
			$input['filename'] = json_encode($data);
		}

		$producto = ProductoRepository::create($input);

		$arr['id_producto'] = $producto->id;
		$arr['attribute_id'] = $idAtributo;

		AtributoProductoRepository::create($arr);

		return Redirect::route('producto.show', ['producto' => $producto->id])
			->with('success', trans('messages.producto.store_success'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{
		$producto = ProductoRepository::paginate();
		$links = ProductoRepository::links();

		return View::make('productos.show', ['producto' => $producto,'links'=>$links]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$producto = ProductoRepository::find($id);
		$this->checkProduct($producto);

		$categoria = CategoriaRepository::all();

		$stockName = array(
			array('nombre'=>Config::EN_STOCK_LABEL,'value'=>Config::EN_STOCK),
			array('nombre'=>Config::AGOTADO_LABEL,'value'=>Config::AGOTADO),
			array('nombre'=>Config::PRONTO_LABEL,'value'=>Config::PRONTO)
		);

		return View::make('productos.edit', [
			'producto' => $producto,
			'categorias' => $categoria,
			'stock' => $stockName]);
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
		$input = Binput::only(['producto',
			'codigo',
			'descripcion',
			'id_categoria',
			'id_stock',
			'precio',
			'oferta']);

		$val = ProductoRepository::validate($input, array_keys($input));
		if ($val->fails()) {
			return Redirect::route('producto.edit', ['producto' => $id])->withInput()->withErrors($val->errors());
		}

		$producto = ProductoRepository::find($id);
		$this->checkProduct($producto);

		$producto->update($input);

		return Redirect::route('producto.show', ['producto' => $producto->id])
			->with('success', trans('messages.producto.update_success'));
	}


	/**
	 * Deshabilita visualizacion de un producto
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function disable() {
		$id = $_POST['id_producto'];
		$producto = ProductoRepository::find($id);
		$this->checkProduct($producto);

		if($_POST['visibilidad']==1)
			$input['visibilidad'] = 0;
		else if($_POST['visibilidad']==0)
			$input['visibilidad'] = 1;

		$producto->update($input);

		return Redirect::route('producto.index')
			->with('success', trans('messages.producto.update_success'));
	}


	/**
	 * Elimina un producto
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		$producto = ProductoRepository::find($id);
		$this->checkProduct($producto);

		$producto->delete();

		return Redirect::route('producto.index')
			->with('success', trans('messages.producto.delete_success'));
	}

	/**
	 * Revisa el modelo del producto
	 *
	 * @param mixed $product
	 * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
	 * @return void
	 */
	protected function checkProduct($product) {
		if (!$product) {
			throw new NotFoundHttpException('Producto No Encontrado');
		}
	}
}
