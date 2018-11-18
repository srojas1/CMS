<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use GrahamCampbell\Binput\Facades\Binput;
use GrahamCampbell\BootstrapCMS\Facades\ProductoRepository;
use GrahamCampbell\BootstrapCMS\Facades\CategoriaRepository;
use GrahamCampbell\BootstrapCMS\Models\Category;
use GrahamCampbell\BootstrapCMS\Models\Product;
use GrahamCampbell\Credentials\Facades\Credentials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use GrahamCampbell\BootstrapCMS\Http\Constants as Config;

class ProductoController extends AbstractController
{
	/**
	 * Create a new instance.
	 *
	 * @return void
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

        $this->producto = Product::with('getCategoryById')->get();

		parent::__construct();
	}

	/**
	 * Display a listing of products.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		$producto = ProductoRepository::paginate();
        $links = ProductoRepository::links();

        return View::make('productos.index', ['producto' => $producto,'links'=>$links]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$categorias = CategoriaRepository::all();

		$stockName = array(
		    array('nombre'=>Config::EN_STOCK_LABEL,'value'=>Config::EN_STOCK),
            array('nombre'=>Config::AGOTADO_LABEL,'value'=>Config::AGOTADO),
            array('nombre'=>Config::PRONTO_LABEL,'value'=>Config::PRONTO)
        );

		return View::make('productos.create',['categorias' => $categorias, 'stock' => $stockName]);
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
			'producto'
		]));

		$val = ProductoRepository::validate($input, array_keys($input));

		if ($val->fails()) {
			return Redirect::route('producto.create')->withInput()->withErrors($val->errors());
		}

        if($request->hasfile('filename')) {
            var_dump($request->file('filename'));
        }
//        foreach($request->file('filename') as $image) {
//            var_dump($image);
//        }

		$producto = ProductoRepository::create($request->all());

		return Redirect::route('producto.show', ['producto'=>$producto->id])
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

        $val = $val = ProductoRepository::validate($input, array_keys($input));
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
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $producto = ProductoRepository::find($id);
        $this->checkProduct($producto);

        $producto->delete();

        return Redirect::route('producto.index')
            ->with('success', trans('messages.producto.delete_success'));
	}

    /**
     * Check the product model.
     *
     * @param mixed $product
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return void
     */
    protected function checkProduct($product)
    {
        if (!$product) {
            throw new NotFoundHttpException('Producto No Encontrado');
        }
    }
}
