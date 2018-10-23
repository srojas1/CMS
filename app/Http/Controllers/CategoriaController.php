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
	public function store() {
		$input = array_merge(['user_id' => Credentials::getuser()->id], Binput::only([
			'categoria',
		]));

		$val = CategoriaRepository::validate($input, array_keys($input));

		if ($val->fails()) {
			return Redirect::route('categorias.create')->withInput()->withErrors($val->errors());
		}

		$categoria = CategoriaRepository::create($input);

		var_dump($categoria);

		return Redirect::route('categorias.index', ['categoria' => $categoria]);
	}


}