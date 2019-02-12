<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// send users to the home page
$router->get('/', ['as' => 'base', function () {
    Session::flash('', ''); // work around laravel bug if there is no session yet
    Session::reflash();

    return Redirect::to('account/login');
}]);

// send users to the posts page
if (Config::get('cms.blogging')) {
    $router->get('blog', ['as' => 'blog', function () {
        Session::flash('', ''); // work around laravel bug if there is no session yet
        Session::reflash();

        return Redirect::route('blog.posts.index');
    }]);
}

// page routes
$router->resource('pages', 'PageController');

// blog routes
if (Config::get('cms.blogging')) {
    $router->resource('blog/posts', 'PostController');
    $router->resource('blog/posts.comments', 'CommentController');
}

// event routes
if (Config::get('cms.events')) {
    $router->resource('events', 'EventController');
}

/**
 *   CMS Developing
 */

$router->resource('bienvenido', 'BienvenidoController');
$router->resource('dashboard', 'DashboardController');
$router->resource('conf_empresa', 'ConfiguracionEmpresaController');
$router->resource('pdf_pedido', 'PdfController');

// categorias routes
if (Config::get('cms.categoria')) {
	$router->resource('categoria', 'CategoriaController');
}

if (Config::get('cms.producto')) {
		$router->resource('producto', 'ProductoController');
}

$router->resource('cliente', 'ClienteController');
$router->resource('pedido', 'PedidoController');
$router->resource('promocion', 'PromocionController');
$router->resource('cupon', 'CuponController');
$router->resource('atributo', 'AtributoController');
$router->resource('recompensa', 'RecompensaController');

$router->resource('personaliza_app', 'PersonalizaAppController');
$router->resource('chat', 'ChatController');
$router->resource('configuracion', 'ConfiguracionControllerOld');

//Ajax Contollers
Route::post('pedido/changeStatus', 'PedidoController@ChangeStatus');
Route::post('categoria/create', 'CategoriaController@create');
Route::post('categoria/update', 'CategoriaController@update');
Route::post('producto/create', 'ProductoController@create');
Route::post('atributo/storeAtributo', 'AtributoController@storeAtributo');
Route::post('producto/update', 'ProductoController@update');
Route::post('atributo/destroyAtributo', 'AtributoController@destroyAtributo');
Route::post('atributo/addAtributoProductoFromEdit', 'AtributoController@addAtributoProductoFromEdit');
Route::post('promocion/storePromocion', 'PromocionController@storePromocion');
Route::post('cupon/storeCupon', 'CuponController@storeCupon');
Route::post('recompensa/storeRecompensa', 'RecompensaController@storeRecompensa');
Route::post('promocion/editPromocion', 'PromocionController@editPromocion');
Route::post('cupon/editCupon', 'CuponController@editCupon');
Route::post('recompensa/editRecompensa', 'RecompensaController@editRecompensa');
Route::post('confEmpresa/editEmpresa', 'ConfiguracionEmpresaController@editEmpresa');
Route::post('producto/disable', 'ProductoController@disable');

Route::get('get_empresas','APIController@GetEmpresas');
Route::post('get_productos','APIController@GetProductos');
Route::post('get_categorias','APIController@GetCategorias');
Route::post('add_categoria','APIController@AddCategoria');
Route::post('validar_cliente','APIController@ValidarCliente');