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
	| Category Model
	|--------------------------------------------------------------------------
	|
	| This defines the categoria model to be used.
	|
	| Default: 'GrahamCampbell\BootstrapCMS\Models\Category'
	|
	*/

	'categoria' => 'GrahamCampbell\BootstrapCMS\Models\Category',

	/*
	|--------------------------------------------------------------------------
	| Product Model
	|--------------------------------------------------------------------------
	|
	| This defines the producto model to be used.
	|
	| Default: 'GrahamCampbell\BootstrapCMS\Models\Product'
	|
	*/

	'producto' => 'GrahamCampbell\BootstrapCMS\Models\Product',

	/*
	|--------------------------------------------------------------------------
	| Client Model
	|--------------------------------------------------------------------------
	|
	| This defines the cliente model to be used.
	|
	| Default: 'GrahamCampbell\BootstrapCMS\Models\Client'
	|
	*/

	'cliente' => 'GrahamCampbell\BootstrapCMS\Models\Client',

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

	'pedido' => 'GrahamCampbell\BootstrapCMS\Models\Order',

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

	'estado' => 'GrahamCampbell\BootstrapCMS\Models\Status',

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

	'atributo' => 'GrahamCampbell\BootstrapCMS\Models\Attribute',


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

    'atributoproducto' => 'GrahamCampbell\BootstrapCMS\Models\AttributeProduct',
];