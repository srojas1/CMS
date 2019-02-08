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
	 * Graba un nuevo producto (nuevo)
	 */
	public function create(Request $request) {

		//Get Data
		$input['producto']     = $request->input('nombreProducto');
		$input['codigo']       = $request->input('codigoProducto');
		$input['descripcion']  = $request->input('descripcionProducto');
		$input['categoria_id'] = $request->input('selectCategorias');
		$input['id_stock']     = $request->input('stockValue_add');
		$input['sku']          = $request->input('sku');
		$input['id_moneda']    = 1;
		$input['precio']       = $request->input('precio');
		$input['oferta']       = $request->input('oferta');
		$input['visibilidad']  = $request->input('visibilidad_add');
		$vinculacionList       = $request->input('productoVinculado');

		//Multiple images
		if ($request->hasfile('filename')) {

			$images = $request->file('filename');

			foreach ($images as $key => $image) {
				if (!empty($image)) {
					$name = $image->getClientOriginalName();
					$image->move(public_path() . '/images/', $name);
					$data[] = $name;
				} else
					continue;
			}

			if (!empty($data)) {
				$input['filename'] = json_encode($data);
			}
		}

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
				$input['vinculacion'] = json_encode($vincArr);
			}
		}

		$input['id_usuario'] = $this->GetUserId();
		$producto = ProductoRepository::create($input);

		$atributosList  = $request->input('atributoProductoVal');

		if(!empty($atributosList)) {

			//Multiple attributes
			foreach($atributosList as $nkey=>$atr) {
				$inputAttr['atributo_id']  = $nkey;
				$inputAttr['valor'] = $atr;
				$inputAttr['id_producto'] = $producto->id;

				AtributoProductoRepository::create($inputAttr);
			}
		}

		return json_encode($producto);
	}

	/**
	 * Edita un Producto
	 */
	public function update(Request $request) {

		//Get Data
		$input['producto']     = $request->input('nombreProducto');
		$input['codigo']       = $request->input('codigoProducto');
		$input['descripcion']  = $request->input('descripcionProducto');
		$input['categoria_id'] = $request->input('selectCategorias');
		$input['id_stock']     = $request->input('stockValue_edit');
		$input['sku']          = $request->input('sku');
		$input['id_moneda']    = 1;
		$input['precio']       = $request->input('precio');
		$input['oferta']       = $request->input('oferta');
		$input['visibilidad']  = $request->input('visibilidad_edit');
		$vinculacionList       = $request->input('productoVinculadoEdit');

		//Multiple images
		if ($request->hasfile('filename')) {

			$images = $request->file('filename');

			foreach ($images as $key => $image) {
				if (!empty($image)) {
					$name = $image->getClientOriginalName();
					$image->move(public_path() . '/images/', $name);
					$data[] = $name;
				} else
					continue;
			}

			if (!empty($data)) {
				$input['filename'] = json_encode($data);
			}
		}

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
				$input['vinculacion'] = json_encode($vincArr);
			}
		}
		else {
			$vincArr = array();
			$input['vinculacion'] = json_encode($vincArr);
		}

		$id = $request->input('id_producto');

		$atributosList  = $request->input('atributoProductoVal');

		if(!empty($atributosList))
		{
			//Multiple attributes
			foreach($atributosList as $nkey=>$atrProdID) {

				$atrProd = AtributoProductoRepository::find($nkey);

				$inputAtr['valor'] = $atrProdID;

				$atrProd->update($inputAtr);
			}
		}

		$producto = ProductoRepository::find($id);

		$producto->update($input);

		return json_encode($producto);
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
