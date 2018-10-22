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
	 * Display a listing of the events.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		$categoria = CategoriaRepository::paginate();
        //$links = EventRepository::links();



		return View::make('categorias.index', ['categoria' => $categoria]);
	}

}