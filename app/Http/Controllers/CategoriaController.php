<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use GrahamCampbell\BootstrapCMS\Facades\CategoriaRepository;
use GrahamCampbell\BootstrapCMS\Http\Libraries\ElementLibrary;
use GrahamCampbell\BootstrapCMS\Models\Empresa;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoriaController extends AbstractController {

	/**
	 * Crear nueva instancia
	 *
	 * @return void
	 */
	public function __construct() {
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
	 * Mostrar lista de categorias
	 *
	 * @return \Illuminate\View\View
	 */
	public function index() {

		$categoria = CategoriaRepository::paginate();
		$empresa   = Empresa::first();

		$elementLibrary = new ElementLibrary();
		$categoria = $elementLibrary->validacionEmpresa($categoria,$empresa);

		return View::make('categorias.index', ['categoria' => $categoria]);
	}

	/**
	 * Guarda nueva categoría (nuevo)
	 *
	 * @param Request $request
	 * @return false|string
	 */
	public function create(Request $request) {

		$input['categoria'] = $request->input('categoria');

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

		$input['id_usuario'] = $this->GetUserId();

		$categoria = CategoriaRepository::create($input);

		return json_encode($categoria);
	}

	/**
	 * Editar categoría
	 *
	 * @param Request $request
	 * @return false|string
	 */
	public function update(Request $request) {

		//Get Data
		$input['categoria']     = $request->input('nombreCategoria');
		$id = $request->input('id_categoria');

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

		$categoria = CategoriaRepository::find($id);

		$categoria->update($input);

		return json_encode($categoria);
	}

	/**
	 * Elimina categoría existente
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {

		$categoria = CategoriaRepository::find($id);
		$this->checkCategoria($categoria);

		$categoria->delete();

		return Redirect::route('producto.index')
			->with('success', trans('messages.categoria.delete_success'));
	}

	/**
	 * Revisa el modelo de la categoría
	 *
	 * @param mixed $category
	 * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
	 * @return void
	 */
	protected function checkCategoria($category) {

		if (!$category) {
			throw new NotFoundHttpException('Categoria No Encontrada');
		}
	}
}