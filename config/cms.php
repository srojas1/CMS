<?php

	/*
	* This file is part of Bootstrap CMS.
	*
	* (c) Graham Campbell <graham@alt-three.com>
	*
	* For the full copyright and license information, please view the LICENSE
	* file that was distributed with this source code.
	*/

	return [

	/*
	|--------------------------------------------------------------------------
	| Site Description
	|--------------------------------------------------------------------------
	|
	| This defines the site description.
	|
	| Default to 'Bootstrap CMS is a PHP CMS powered by Laravel 5.'.
	|
	*/

	'description' => env('CMS_DESC', 'Bootstrap CMS is a PHP CMS powered by Laravel 5.'),

	/*
	|--------------------------------------------------------------------------
	| Site Author
	|--------------------------------------------------------------------------
	|
	| This defines the site author.
	|
	| Default to 'Graham Campbell'.
	|
	*/

	'author' => env('CMS_AUTHOR', 'Graham Campbell'),

	/*
	|--------------------------------------------------------------------------
	| Navigation Text
	|--------------------------------------------------------------------------
	|
	| This defines property from the user model to use on the navigation bar.
	|
	| This could be: 'email', 'name', 'first_name', 'last_name'
	|
	| Default to 'email'.
	|
	*/

	'nav' => env('CMS_NAV', 'email'),

	/*
	|--------------------------------------------------------------------------
	| Enable Eval On Pages
	|--------------------------------------------------------------------------
	|
	| This defines if the page eval functionality is enabled.
	|
	| Disabling it will prevent people from executing php on pages. This would
	| be useful if you wanted to prevent users writing dynamic pages, because
	| allowing them to execute php means they can do anything really.
	|
	| Default to true.
	|
	*/

	'eval' => env('CMS_EVAL', true),

	/*
	|--------------------------------------------------------------------------
	| Enable Blogging
	|--------------------------------------------------------------------------
	|
	| This defines if the blog functionality is enabled.
	|
	| Disabling it will not delete anything from your database, it will just
	| inaccessible from the web. All associated routes will not be registered,
	| and the navigation bar will not show any associated links.
	|
	| Default to true.
	|
	*/

	'blogging' => env('CMS_BLOGGING', true),

	/*
	|--------------------------------------------------------------------------
	| Comment Fetch Interval
	|--------------------------------------------------------------------------
	|
	| This defines the minimum time interval for a client's browser to check
	| for new comments on a blog post in milliseconds.
	|
	| Default to 5000.
	|
	*/

	'commentfetch' => 5000,

	/*
	|--------------------------------------------------------------------------
	| Comment Transition Time
	|--------------------------------------------------------------------------
	|
	| This defines how long comment transitions take to complete inproducto
	| milliseconds. It must be a number divisible by 2.
	|
	| Default to 300.
	|
	*/

	'commenttrans' => 300,

	/*
	|--------------------------------------------------------------------------
	| Enable Events
	|--------------------------------------------------------------------------
	|
	| This defines if the event functionality is enabled.
	|
	| Disabling it will not delete anything from your database, it will just
	| inaccessible from the web. All associated routes will not be registered,
	| and the navigation bar will not show any associated links.
	|
	| Default to true.
	|
	*/

	'events' => env('CMS_EVENTS', true),

	/*
	|--------------------------------------------------------------------------
	| Comment Model
	|--------------------------------------------------------------------------
	|
	| This defines the comment model to be used.
	|
	| Default: 'GrahamCampbell\BootstrapCMS\Models\Comment'
	|
	*/

	'comment' => 'GrahamCampbell\BootstrapCMS\Models\Comment',

	/*
	|--------------------------------------------------------------------------
	| Event Model
	|---------------------------------------------------------------producto-----------
	|
	| This defines the event model to be used.
	|
	| Default: 'GrahamCampbell\BootstrapCMS\Models\Event'
	|
	*/

	'event' => 'GrahamCampbell\BootstrapCMS\Models\Event',

	/*
	|--------------------------------------------------------------------------
	| Page Model
	|--------------------------------------------------------------------------
	|
	| This defines the page model to be used.
	|
	| Default: 'GrahamCampbell\BootstrapCMS\Models\Page'
	|
	*/

	'page' => 'GrahamCampbell\BootstrapCMS\Models\Page',

	/*
	|--------------------------------------------------------------------------
	| Post Model
	|--------------------------------------------------------------------------
	|
	| This defines the post model to be used.
	|
	| Default: 'GrahamCampbell\BootstrapCMS\Models\Post'
	|
	*/

	'post' => 'GrahamCampbell\BootstrapCMS\Models\Post',

	/*
	|--------------------------------------------------------------------------
	| Categoria Model
	|--------------------------------------------------------------------------
	|
	| This defines the categoria model to be used.
	|
	| Default: 'GrahamCampbell\BootstrapCMS\Models\Categoria'
	|
	*/

	'categoria' => 'GrahamCampbell\BootstrapCMS\Models\Categoria',

	/*
	|--------------------------------------------------------------------------
	| Product Model
	|--------------------------------------------------------------------------
	|
	| This defines the producto model to be used.
	|
	| Default: 'GrahamCampbell\BootstrapCMS\Models\Producto'
	|
	*/

	'producto' => 'GrahamCampbell\BootstrapCMS\Models\Producto',

	/*
	|--------------------------------------------------------------------------
	| Client Model
	|--------------------------------------------------------------------------
	|
	| This defines the cliente model to be used.
	|
	| Default: 'GrahamCampbell\BootstrapCMS\Models\Cliente'
	|
	*/

	'cliente' => 'GrahamCampbell\BootstrapCMS\Models\Cliente',

	/*
	|--------------------------------------------------------------------------
	| Order Model
	|--------------------------------------------------------------------------
	|
	| This defines the order model to be used.
	|
	| Default: 'GrahamCampbell\BootstrapCMS\Models\Order'
	|
	*/

	'pedido' => 'GrahamCampbell\BootstrapCMS\Models\Orden',

	/*
	|--------------------------------------------------------------------------
	| OrderProducto Model
	|--------------------------------------------------------------------------
	|
	| This defines the order model to be used.
	|
	| Default: 'GrahamCampbell\BootstrapCMS\Models\PedidoProducto'
	|
	*/

	'pedidoproducto' => 'GrahamCampbell\BootstrapCMS\Models\OrdenProducto',

	/*
	|--------------------------------------------------------------------------
	| Status Model
	|--------------------------------------------------------------------------
	|
	| This defines the order model to be used.
	|
	| Default: 'GrahamCampbell\BootstrapCMS\Models\Status'
	|
	*/

	'estado' => 'GrahamCampbell\BootstrapCMS\Models\Estado',

	/*
	|--------------------------------------------------------------------------
	| Promo Model
	|--------------------------------------------------------------------------
	|
	| This defines the order model to be used.
	|
	| Default: 'GrahamCampbell\BootstrapCMS\Models\Promo'
	|
	*/

	'promocion' => 'GrahamCampbell\BootstrapCMS\Models\Promo',

	/*
	|--------------------------------------------------------------------------
	| Attribute Model
	|--------------------------------------------------------------------------
	|
	| This defines the order model to be used.
	|
	| Default: 'GrahamCampbell\BootstrapCMS\Models\Attribute'
	|
	*/

	'atributo' => 'GrahamCampbell\BootstrapCMS\Models\Atributo',


	/*
	|--------------------------------------------------------------------------
	| Currency Model
	|--------------------------------------------------------------------------
	|
	| This defines the order model to be used.
	|
	| Default: 'GrahamCampbell\BootstrapCMS\Models\Attribute'
	|
	*/

	'moneda' => 'GrahamCampbell\BootstrapCMS\Models\Currency',

	/*
	|--------------------------------------------------------------------------
	| Cupon Model
	|--------------------------------------------------------------------------
	|
	| This defines the cupon model to be used.
	|
	| Default: 'GrahamCampbell\BootstrapCMS\Models\Cupon'
	|
	*/

		'cupon' => 'GrahamCampbell\BootstrapCMS\Models\Cupon',

	/*
	|--------------------------------------------------------------------------
	| Recompensa Model
	|--------------------------------------------------------------------------
	|
	| This defines the recompensa model to be used.
	|
	| Default: 'GrahamCampbell\BootstrapCMS\Models\Recompensa'
	|
	*/

	'recompensa' => 'GrahamCampbell\BootstrapCMS\Models\Recompensa',

    /*
    |--------------------------------------------------------------------------
    | Atributo Producto Model
    |--------------------------------------------------------------------------
    |
    | This defines the recompensa model to be used.
    |
    | Default: 'GrahamCampbell\BootstrapCMS\Models\AtributoProducto'
    |
    */

    'atributoproducto' => 'GrahamCampbell\BootstrapCMS\Models\AtributoProducto',
		
	/*
	|--------------------------------------------------------------------------
	| Atributo Opcion Model
	|--------------------------------------------------------------------------
	|
	| This defines the recompensa model to be used.
	|
	| Default: 'GrahamCampbell\BootstrapCMS\Models\AtributoOpcion'
	|
	*/
		
		'atributoopcion' => 'GrahamCampbell\BootstrapCMS\Models\AtributoOpcion',
		
	/*
	|--------------------------------------------------------------------------
	| Cupon Cliente Model
	|--------------------------------------------------------------------------
	|
	| This defines the cupon cliente model to be used.
	|
	| Default: 'GrahamCampbell\BootstrapCMS\Models\CuponClient'
	|
	*/

		'cuponcliente' => 'GrahamCampbell\BootstrapCMS\Models\CuponCliente',

	/*
	|--------------------------------------------------------------------------
	| Distrito Model
	|--------------------------------------------------------------------------
	|
	| This defines the recompensa model to be used.
	|
	| Default: 'GrahamCampbell\BootstrapCMS\Models\District'
	|
	*/

		'districts' => 'GrahamCampbell\BootstrapCMS\Models\Distrito',

	/*
	|--------------------------------------------------------------------------
	| Direccion Model
	|--------------------------------------------------------------------------
	|
	| This defines the model to be used.
	|
	| Default: 'GrahamCampbell\BootstrapCMS\Models\Direccion'
	|
	*/

	'direccion' => 'GrahamCampbell\BootstrapCMS\Models\Direccion',

	/*
	|--------------------------------------------------------------------------
	| Tipo Direccion Model
	|--------------------------------------------------------------------------
	|
	| This defines the model to be used.
	|
	| Default: 'GrahamCampbell\BootstrapCMS\Models\AddressType'
	|
	*/

		'addresstype' => 'GrahamCampbell\BootstrapCMS\Models\AddressType',

	/*
	|--------------------------------------------------------------------------
	| Empresa Model
	|--------------------------------------------------------------------------
	|
	| This defines the model to be used.
	|
	| Default: 'GrahamCampbell\BootstrapCMS\Models\Empresa'
	|
	*/

		'empresa' => 'GrahamCampbell\BootstrapCMS\Models\Empresa',

	/*
	|--------------------------------------------------------------------------
	| Status Detail
	|--------------------------------------------------------------------------
	|
	| This defines the model to be used.
	|
	| Default: 'GrahamCampbell\BootstrapCMS\Models\StatusDetail'
	|
	*/

		'statusdetail' => 'GrahamCampbell\BootstrapCMS\Models\StatusDetail',

	/*
	|--------------------------------------------------------------------------
	| Forma Pago
	|--------------------------------------------------------------------------
	|
	| This defines the model to be used.
	|
	| Default: 'GrahamCampbell\BootstrapCMS\Models\FormaPago'
	|
	*/

		'formapago' => 'GrahamCampbell\BootstrapCMS\Models\FormaPago',

	/*
	|--------------------------------------------------------------------------
	| Pago Contraentrega detalle
	|--------------------------------------------------------------------------
	|
	| This defines the model to be used.
	|
	| Default: 'GrahamCampbell\BootstrapCMS\Models\PagoContraentregaDetalle'
	|
	*/

		'pagocontraentregadetalle' => 'GrahamCampbell\BootstrapCMS\Models\PagoContraentregaDetalle',
];