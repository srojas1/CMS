<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use GrahamCampbell\BootstrapCMS\Facades\AtributoOpcionRepository;
use Illuminate\Support\Facades\View;
use GrahamCampbell\BootstrapCMS\Facades\AtributoProductoRepository;
use GrahamCampbell\BootstrapCMS\Facades\AtributoRepository;
use GrahamCampbell\Credentials\Credentials;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AtributoController extends AbstractController {

	/**
	 * Crear nueva instancia
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
	 * Mostrar lista del recurso
	 *
	 * @param Credentials $credentials
	 * @return \Illuminate\View\View
	 */
	public function index(Credentials $credentials) {

		if (!$credentials->check()) {
			return Redirect::route('account.login');
		}

		$atributo = AtributoRepository::paginate();

		return View::make('atributos.index', ['atributo'=>$atributo]);
	}

	/**
	 * Muestra el formulario para crear un nuevo recurso
	 *
	 * @return \Illuminate\View\View
	 */
	public function create() {
		return View::make('atributos.create');
	}

	/**
	 * Guarda un nuevo atributo
	 */
	public function storeAtributo() {

		$atributo    = $_POST['atributo'];
		$valores     = $_POST['valores'];

		$input = ['atributo'=>$atributo];
		$atributo = AtributoRepository::create($input);
		
		foreach($valores as $val) {
			$inputOpcion = ['atributo_id'=>$atributo->id,'valor'=>$val];
			AtributoOpcionRepository::create($inputOpcion);
		}

		return json_encode($atributo);
	}

	/**
	 * Elimina atributo
	 */
	public function destroyAtributo() {

		$idAtributo       = $_POST['id'];
		$atributoProducto = AtributoProductoRepository::find($idAtributo);
		$this->checkAtributo($atributoProducto);

		$atributoProducto->delete();
	}

	/**
	 * Añade Atributo en ventana de edicion
	 */
	public function addAtributoProductoFromEdit() {

		$attribute_id = $_POST['attribute_id'];
		$id_producto  = $_POST['id_producto'];

		$input = ['atributo_id'=>$attribute_id,'producto_id'=>$id_producto];

		$atributoProducto = AtributoProductoRepository::create($input);

		return json_encode($atributoProducto);

	}

	/**
	 * Revisa si existe modelo
	 *
	 * @param mixed $atributo
	 * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
	 * @return void
	 */
	protected function checkAtributo($atributo) {
		if (!$atributo) {
			throw new NotFoundHttpException('Atributo No Encontrado');
		}
	}
}
