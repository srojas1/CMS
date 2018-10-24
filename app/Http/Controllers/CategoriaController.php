<?php
/**
 * Created by PhpStorm.
 * User: srojas
 * Date: 18/10/18
 * Time: 04:29 PM
 */

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;
use Carbon\Carbon;
use GrahamCampbell\Binput\Facades\Binput;
use GrahamCampbell\BootstrapCMS\Facades\CategoriaRepository;
use GrahamCampbell\Credentials\Facades\Credentials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
			return Redirect::route('categorias.create')->withInput()->withErrors($val->errors());
		}

		$categoria = CategoriaRepository::create($request->all());

		return Redirect::route('categoria.show', [''])
            ->with('success', trans('messages.categoria.store_success'));
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
     * Show the form for editing the specified event.
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
            return Redirect::route('categorias.edit', ['categoria' => $id])->withInput()->withErrors($val->errors());
        }

        $categoria = CategoriaRepository::find($id);
        $this->checkCategory($categoria);

        $categoria->update($input);

        return Redirect::route('categorias.show', ['categoria' => $categoria->id])
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
        $this->checkCategory($categoria);

        var_dump($categoria);

        $categoria->delete();

        return Redirect::route('categoria.index')
            ->with('success', trans('messages.categoria.delete_success'));
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
            throw new NotFoundHttpException('Event Not Found');
        }
    }
}