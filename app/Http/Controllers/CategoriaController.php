<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use GrahamCampbell\Binput\Facades\Binput;
use GrahamCampbell\BootstrapCMS\Facades\CategoriaRepository;
use GrahamCampbell\Credentials\Facades\Credentials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use GrahamCampbell\BootstrapCMS\Models\Empresa;
use GrahamCampbell\BootstrapCMS\Http\Libraries\ElementLibrary;

/**
 * Class CategoriaController
 *
 * @package GrahamCampbell\BootstrapCMS\Http\Controllers
 */
class CategoriaController extends AbstractController {

	/**
	 * Crear nueva instancia
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
	 * Mostrar lista de categorias
	 * @return \Illuminate\View\View
	 */
	public function index(Credentials $credentials) {

		if (!$credentials->check()) {
			return Redirect::route('account.login');
		}

		$categoria = CategoriaRepository::paginate();
		$empresa   = Empresa::first();

		$elementLibrary = new ElementLibrary();
		$categoria = $elementLibrary->validacionEmpresa($categoria,$empresa);

		return View::make('categorias.index', ['categoria' => $categoria]);
	}

	/**
	 * Muestra formulario para crear nueva categoría
	 * @return \Illuminate\View\View
	 */
	public function create() {
		return View::make('categorias.create');
	}

	/**
	 * Guarda nueva categoría
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
	* Guarda nueva categoría (nuevo)
	*/
	public function storeCategory(Request $request) {

		$input['categoria'] = $request->input('categoria');

		//Main image
		if ($request->hasfile('filename_main')) {

			$images_main = $request->file('filename_main');
			$name_main = $images_main->getClientOriginalName();

			$images_main->move(public_path() . '/images/', $name_main);
			$data_main[] = $name_main;

			if (!empty($data_main)) {
				$input['filename_main'] = json_encode($data_main);
			}
		}

		$categoria = CategoriaRepository::create($input);

		return json_encode($categoria);
	}

	/**
	 * Editar categoría
	 */
	public function editCategoria(Request $request) {

		//Get Data
		$input['categoria']     = $request->input('nombreCategoria');
		$id = $request->input('id_categoria');

		//Main image
		if ($request->hasfile('filename_main')) {

			$images_main = $request->file('filename_main');
			$name_main = $images_main->getClientOriginalName();

			$images_main->move(public_path() . '/images/', $name_main);
			$data_main[] = $name_main;

			if (!empty($data_main)) {
				$input['filename_main'] = json_encode($data_main);
			}
		}

		$categoria = CategoriaRepository::find($id);

		$categoria->update($input);

		return json_encode($categoria);
	}

	/**
	 * Muestra categoría específica
	 *
	 * @param int $id
	 * @return \Illuminate\View\View
	 */
	public function show()
	{
		$categoria = CategoriaRepository::paginate();

		return View::make('categorias.show', ['categoria' => $categoria]);
	}

	/**
	 * Muestra formulario para editar categoría específica
	 *
	 * @param int $id
	 * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$categoria = CategoriaRepository::find($id);
		$this->checkCategoria($categoria);

		return View::make('categorias.edit', ['categoria' => $categoria]);
	}

	/**
	 * Actualiza categoría existente
	 *
	 * @param int $id
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
		$this->checkCategoria($categoria);

		$categoria->update($input);

		return Redirect::route('categoria.show', ['categoria' => $categoria->id])
			->with('success', trans('messages.categoria.update_success'));
	}

	/**
	 * Elimina categoría existente
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
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