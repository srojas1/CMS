<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;
use GrahamCampbell\Binput\Facades\Binput;
use GrahamCampbell\BootstrapCMS\Facades\ProductoRepository;
use GrahamCampbell\BootstrapCMS\Facades\CategoriaRepository;
use GrahamCampbell\Credentials\Facades\Credentials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\VarDumper\Cloner\VarCloner;

/**
 * Class CategoriaController
 *
 * @package GrahamCampbell\BootstrapCMS\Http\Controllers
 */
class CategoriaController extends AbstractController {
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

		parent::__construct();
	}

	/**
	 * Display a listing of the categories.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index() {
		$categoria = CategoriaRepository::paginate();

        //$links = EventRepository::links();

		return View::make('categorias.index', ['categoria' => $categoria]);
	}

	/**
	 * Show the form for creating a new category.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create() {
		return View::make('categorias.create');
	}

	/**
	 * Store a new category.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {

		$input = array_merge(['user_id' => Credentials::getuser()->id], Binput::only([
			'categoria'
		]));

		$val = CategoriaRepository::validate($input, array_keys($input));

		if ($val->fails()) {
			return Redirect::route('categoria.create')->withInput()->withErrors($val->errors());
		}

		$categoria = CategoriaRepository::create($request->all());

		return Redirect::route('categoria.show', ['categoria'=>$categoria->id])
            ->with('success', trans('messages.categoria.store_success'));
	}

	/**
	* Store a new category.
	*/
	public function storeCategory() {

		$categoria = $_POST['categoria'];

		$input = ['categoria'=>$categoria];

		$categoria = CategoriaRepository::create($input);

//		$productActive = "";
//		$categoryActive = "active";

//        return View::make('productos.index', ['categoria' => $categoria,
//                                       'productActive' => $productActive,
//                                       'categoryActive' => $categoryActive])
//			->with('success', trans('messages.categoria.store_success'));

        return json_encode($categoria);
    }

	/**
     * Show the specified category.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $categoria = CategoriaRepository::paginate();

        return View::make('categorias.show', ['categoria' => $categoria]);
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $categoria = CategoriaRepository::find($id);
        $this->checkCategory($categoria);

        return View::make('categorias.edit', ['categoria' => $categoria]);
    }

    /**
     * Update an existing category.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
		$input = Binput::only(['categoria']);

        $val = $val = CategoriaRepository::validate($input, array_keys($input));
        if ($val->fails()) {
            return Redirect::route('categoria.edit', ['categoria' => $id])->withInput()->withErrors($val->errors());
        }

        $categoria = CategoriaRepository::find($id);
        $this->checkCategory($categoria);

        $categoria->update($input);

        return Redirect::route('categoria.show', ['categoria' => $categoria->id])
            ->with('success', trans('messages.categoria.update_success'));
    }

    /**
     * Delete an existing category.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = CategoriaRepository::find($id);
        $producto  = ProductoRepository::paginate();
        $this->checkCategory($categoria);

        $categoria->delete();

//        $productActive = "active";
//        $categoryActive = "";
//
//        $categoria = CategoriaRepository::paginate();

//        return View::make('productos.index',[
//            'producto' => $producto,
//            'productActive' => $productActive,
//            'categoryActive' => $categoryActive,
//            'category'=>$categoria])
//            ->with('success', trans('messages.categoria.delete_success'));
    }

    /**
     * Check the category model.
     *
     * @param mixed $category
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return void
     */
    protected function checkCategory($category)
    {
        if (!$category) {
            throw new NotFoundHttpException('Categoria No Encontrada');
        }
    }
}