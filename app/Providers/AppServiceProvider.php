<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\BootstrapCMS\Providers;

use GrahamCampbell\BootstrapCMS\Http\Controllers\CommentController;
use GrahamCampbell\BootstrapCMS\Navigation\Factory;
use GrahamCampbell\BootstrapCMS\Observers\PageObserver;
use GrahamCampbell\BootstrapCMS\Repositories\AtributoRepository;
use GrahamCampbell\BootstrapCMS\Repositories\AtributoProductoRepository;
use GrahamCampbell\BootstrapCMS\Repositories\AtributoOpcionRepository;
use GrahamCampbell\BootstrapCMS\Repositories\CuponClienteRepository;
use GrahamCampbell\BootstrapCMS\Repositories\ClienteRepository;
use GrahamCampbell\BootstrapCMS\Repositories\CommentRepository;
use GrahamCampbell\BootstrapCMS\Repositories\EmpresaRepository;
use GrahamCampbell\BootstrapCMS\Repositories\EventRepository;
use GrahamCampbell\BootstrapCMS\Repositories\CategoriaRepository;
use GrahamCampbell\BootstrapCMS\Repositories\PageRepository;
use GrahamCampbell\BootstrapCMS\Repositories\PostRepository;
use GrahamCampbell\BootstrapCMS\Repositories\ProductoRepository;
use GrahamCampbell\BootstrapCMS\Repositories\PedidoRepository;
use GrahamCampbell\BootstrapCMS\Repositories\PedidoProductoRepository;
use GrahamCampbell\BootstrapCMS\Repositories\PromocionRepository;
use GrahamCampbell\BootstrapCMS\Repositories\CuponRepository;
use GrahamCampbell\BootstrapCMS\Repositories\RecompensaRepository;
use GrahamCampbell\BootstrapCMS\Repositories\DireccionRepository;
use GrahamCampbell\BootstrapCMS\Subscribers\CommandSubscriber;
use GrahamCampbell\BootstrapCMS\Subscribers\NavigationSubscriber;
use Illuminate\Support\ServiceProvider;

/**
 * This is the app service provider class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class AppServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->setupBlade();

		$this->setupListeners();
	}

	/**
	 * Setup the blade compiler class.
	 *
	 * @return void
	 */
	protected function setupBlade()
	{
		$blade = $this->app['view']->getEngineResolver()->resolve('blade')->getCompiler();

		$this->app['view']->share('__navtype', 'default');

		$blade->directive('navtype', function ($expression) {
			return "<?php \$__navtype = {$expression}; ?>";
		});

		$blade->directive('navigation', function () {
			return '<?php echo \GrahamCampbell\BootstrapCMS\Facades\NavigationFactory::make($__navtype); ?>';
		});
	}

	/**
	 * Setup the event listeners.
	 *
	 * @return void
	 */
	protected function setupListeners()
	{
		$this->app['events']->subscribe($this->app->make(CommandSubscriber::class));

		$this->app['events']->subscribe($this->app->make(NavigationSubscriber::class));

		$this->app['pagerepository']->observe($this->app->make(PageObserver::class));
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerNavigationFactory();

		$this->registerCommentRepository();
		$this->registerEventRepository();
		$this->registerPageRepository();
		$this->registerPostRepository();
		$this->registerCategoriaRepository();
		$this->registerProductoRepository();
		$this->registerClienteRepository();
		$this->registerPedidoRepository();
		$this->registerPedidoProductoRepository();
		$this->registerPromocionRepository();
		$this->registerCuponRepository();
		$this->registerAtributoRepository();
		$this->registerRecompensaRepository();
		$this->registerAtributoProductoRepository();
		$this->registerAtributoOpcionRepository();
		$this->registerCuponClienteRepository();
		$this->registerEmpresaRepository();
		$this->registerDireccionRepository();

		$this->registerCommandSubscriber();
		$this->registerNavigationSubscriber();

		$this->registerCommentController();
	}

	/**
	 * Register the navigation factory class.
	 *
	 * @return void
	 */
	protected function registerNavigationFactory()
	{
		$this->app->singleton('navfactory', function ($app) {
			$credentials = $app['credentials'];
			$navigation = $app['navigation'];
			$name = $app['config']['app.name'];
			$property = $app['config']['cms.nav'];
			$inverse = $app['config']['theme.inverse'];

			return new Factory($credentials, $navigation, $name, $property, $inverse);
		});

		$this->app->alias('navfactory', 'GrahamCampbell\BootstrapCMS\Navigation\Factory');
	}

	/**
	 * Register the comment repository class.
	 *
	 * @return void
	 */
	protected function registerCommentRepository()
	{
		$this->app->singleton('commentrepository', function ($app) {
			$model = $app['config']['cms.comment'];
			$comment = new $model();

			$validator = $app['validator'];

			return new CommentRepository($comment, $validator);
		});

		$this->app->alias('commentrepository', 'GrahamCampbell\BootstrapCMS\Repositories\CommentRepository');
	}

	/**
	 * Register the event repository class.
	 *
	 * @return void
	 */
	protected function registerEventRepository()
	{
		$this->app->singleton('eventrepository', function ($app) {
			$model = $app['config']['cms.event'];
			$event = new $model();

			$validator = $app['validator'];

			return new EventRepository($event, $validator);
		});

		$this->app->alias('eventrepository', 'GrahamCampbell\BootstrapCMS\Repositories\EventRepository');
	}

	/**
	 * Register the categoria repository class.
	 *
	 * @return void
	 */
	protected function registerCategoriaRepository()
	{
		$this->app->singleton('categoriarepository', function ($app) {
			$model = $app['config']['cms.categoria'];
			$categoria = new $model();

			$validator = $app['validator'];

			return new CategoriaRepository($categoria, $validator);
		});

		$this->app->alias('categoriarepository',
			'GrahamCampbell\BootstrapCMS\Repositories\CategoriaRepository');
	}

	/**
	 * Register the producto repository class.
	 *
	 * @return void
	 */
	protected function registerProductoRepository()
	{
		$this->app->singleton('productorepository', function ($app) {
			$model = $app['config']['cms.producto'];
			$producto = new $model();

			$validator = $app['validator'];

			return new ProductoRepository($producto, $validator);
		});

		$this->app->alias('productorepository',
			'GrahamCampbell\BootstrapCMS\Repositories\ProductoRepository');
	}

	/**
	 * Register the atributo producto repository class.
	 *
	 * @return void
	 */
	protected function registerAtributoProductoRepository()
	{
		$this->app->singleton('atributoproductorepository', function ($app) {
			$model = $app['config']['cms.atributoproducto'];
			$atributoproducto = new $model();

			$validator = $app['validator'];

			return new AtributoProductoRepository($atributoproducto, $validator);
		});

		$this->app->alias('atributoproductorepository',
			'GrahamCampbell\BootstrapCMS\Repositories\AtributoProductoRepository');
	}
	
	/**
	 * Register the atributo opcion repository class.
	 *
	 * @return void
	 */
	protected function registerAtributoOpcionRepository()
	{
		$this->app->singleton('atributoopcionrepository', function ($app) {
			$model = $app['config']['cms.atributoopcion'];
			$atributoproducto = new $model();
			
			$validator = $app['validator'];
			
			return new AtributoOpcionRepository($atributoproducto, $validator);
		});
		
		$this->app->alias('atributoopcionrepository',
			'GrahamCampbell\BootstrapCMS\Repositories\AtributoOpcionRepository');
	}
	
	
	/**
	 * Register the cupon cliente repository class.
	 *
	 * @return void
	 */
	protected function registerCuponClienteRepository()
	{
		$this->app->singleton('cuponclienterepository', function ($app) {
			$model = $app['config']['cms.cuponcliente'];
			$cuponcliente = new $model();

			$validator = $app['validator'];

			return new CuponClienteRepository($cuponcliente, $validator);
		});

		$this->app->alias('cuponclienterepository',
			'GrahamCampbell\BootstrapCMS\Repositories\CuponClienteRepository');
	}

	/**
	 * Register the cliente repository class.
	 *
	 * @return void
	 */
	protected function registerClienteRepository()
	{
		$this->app->singleton('clienterepository', function ($app) {
			$model = $app['config']['cms.cliente'];
			$cliente = new $model();

			$validator = $app['validator'];

			return new ClienteRepository($cliente, $validator);
		});

		$this->app->alias('clienterepository',
			'GrahamCampbell\BootstrapCMS\Repositories\ClienteRepository');
	}

	/**
	 * Register the pedido repository class.
	 *
	 * @return void
	 */
	protected function registerPedidoRepository()
	{
		$this->app->singleton('pedidorepository', function ($app) {
			$model = $app['config']['cms.pedido'];
			$pedido = new $model();

			$validator = $app['validator'];

			return new PedidoRepository($pedido, $validator);
		});

		$this->app->alias('pedidorepository',
			'GrahamCampbell\BootstrapCMS\Repositories\PedidoRepository');
	}

	/**
	 * Register the pedidoprod repository class.
	 *
	 * @return void
	 */
	protected function registerPedidoProductoRepository()
	{
		$this->app->singleton('pedidoproductorepository', function ($app) {
			$model = $app['config']['cms.pedidoproducto'];
			$pedido = new $model();

			$validator = $app['validator'];

			return new PedidoProductoRepository($pedido, $validator);
		});

		$this->app->alias('pedidoproductorepository',
			'GrahamCampbell\BootstrapCMS\Repositories\PedidoProductoRepository');
	}

	/**
	 * Register the promocion repository class.
	 *
	 * @return void
	 */
	protected function registerPromocionRepository()
	{
		$this->app->singleton('promocionrepository', function ($app) {
			$model = $app['config']['cms.promocion'];
			$promocion = new $model();

			$validator = $app['validator'];

			return new PromocionRepository($promocion, $validator);
		});

		$this->app->alias('pedidorepository',
			'GrahamCampbell\BootstrapCMS\Repositories\PedidoRepository');
	}

	/**
	 * Register the cupon repository class.
	 *
	 * @return void
	 */
	protected function registerCuponRepository()
	{
		$this->app->singleton('cuponrepository', function ($app) {
			$model = $app['config']['cms.cupon'];
			$cupon = new $model();

			$validator = $app['validator'];

			return new CuponRepository($cupon, $validator);
		});

		$this->app->alias('cuponrepository',
			'GrahamCampbell\BootstrapCMS\Repositories\CuponRepository');
	}

	/**
	 * Register the cupon repository class.
	 *
	 * @return void
	 */
	protected function registerRecompensaRepository()
	{
		$this->app->singleton('recompensarepository', function ($app) {
			$model = $app['config']['cms.recompensa'];
			$recompensa = new $model();

			$validator = $app['validator'];

			return new RecompensaRepository($recompensa, $validator);
		});

		$this->app->alias('recompensarepository',
			'GrahamCampbell\BootstrapCMS\Repositories\RecompensaRepository');
	}
    
	/**
	 * Register the atributo repository class.
	 *
	 * @return void
	 */
	protected function registerAtributoRepository()
	{
		$this->app->singleton('atributorepository', function ($app) {
			$model = $app['config']['cms.atributo'];
			$pedido = new $model();

			$validator = $app['validator'];

			return new AtributoRepository($pedido, $validator);
		});

		$this->app->alias('atributorepository',
			'GrahamCampbell\BootstrapCMS\Repositories\AtributoRepository');
	}

	/**
	 * Register the atributo repository class.
	 *
	 * @return void
	 */
	protected function registerEmpresaRepository()
	{
		$this->app->singleton('empresarepository', function ($app) {
			$model = $app['config']['cms.empresa'];
			$pedido = new $model();

			$validator = $app['validator'];

			return new EmpresaRepository($pedido, $validator);
		});

		$this->app->alias('empresarepository',
			'GrahamCampbell\BootstrapCMS\Repositories\EmpresaRepository');
	}

	/**
	 * Register the direccion repository class.
	 *
	 * @return void
	 */
	protected function registerDireccionRepository()
	{
		$this->app->singleton('direccionrepository', function ($app) {
			$model = $app['config']['cms.direccion'];
			$cliente = new $model();

			$validator = $app['validator'];

			return new DireccionRepository($cliente, $validator);
		});

		$this->app->alias('direccionrepository',
			'GrahamCampbell\BootstrapCMS\Repositories\DireccionRepository');
	}

	/**
	 * Register the page repository class.
	 *
	 * @return void
	 */
	protected function registerPageRepository()
	{
		$this->app->singleton('pagerepository', function ($app) {
			$model = $app['config']['cms.page'];
			$page = new $model();

			$validator = $app['validator'];

			return new PageRepository($page, $validator);
		});

		$this->app->alias('pagerepository', 'GrahamCampbell\BootstrapCMS\Repositories\PageRepository');
	}

	/**
	 * Register the post repository class.
	 *
	 * @return void
	 */
	protected function registerPostRepository()
	{
		$this->app->singleton('postrepository', function ($app) {
			$model = $app['config']['cms.post'];
			$post = new $model();

			$validator = $app['validator'];

			return new PostRepository($post, $validator);
		});

		$this->app->alias('postrepository', 'GrahamCampbell\BootstrapCMS\Repositories\PostRepository');
	}

	/**
	 * Register the command subscriber class.
	 *
	 * @return void
	 */
	protected function registerCommandSubscriber()
	{
		$this->app->singleton('GrahamCampbell\BootstrapCMS\Subscribers\CommandSubscriber', function ($app) {
			$pagerepository = $app['pagerepository'];

			return new CommandSubscriber($pagerepository);
		});
	}

	/**
	 * Register the navigation subscriber class.
	 *
	 * @return void
	 */
	protected function registerNavigationSubscriber()
	{
		$this->app->singleton('GrahamCampbell\BootstrapCMS\Subscribers\NavigationSubscriber', function ($app) {
			$navigation = $app['navigation'];
			$credentials = $app['credentials'];
			$pagerepository = $app['pagerepository'];
			$blogging = $app['config']['cms.blogging'];
			$events = $app['config']['cms.events'];
			$categoria = $app['config']['cms.categoria'];
			$producto = $app['config']['cms.producto'];
			$pedido = $app['config']['cms.pedido'];
			$promocion = $app['config']['cms.promocion'];
			$cliente = $app['config']['cms.cliente'];
            $cloudflare = class_exists('GrahamCampbell\CloudFlare\CloudFlareServiceProvider');

			return new NavigationSubscriber(
				$navigation,
				$credentials,
				$pagerepository,
				$blogging,
				$events,
				$categoria,
				$producto,
				$pedido,
				$promocion,
				$cliente,
				$cloudflare
			);
		});
	}

	/**
	 * Register the comment controller class.
	 *
	 * @return void
	 */
	protected function registerCommentController()
	{
		$this->app->bind('GrahamCampbell\BootstrapCMS\Http\Controllers\CommentController', function ($app) {
			$throttler = $app['throttle']->get($app['request'], 1, 10);

			return new CommentController($throttler);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return string[]
	 */
	public function provides()
	{
		return [
			'navfactory',
			'commentrepository',
			'eventrepository',
			'fileprovider',
			'folderprovider',
			'pagerepository',
			'postrepository',
			'categoriarepository',
			'productorepository',
			'pedidorepository',
			'pedidoproductorepository',
			'promocionrepository',
			'clienterepository',
			'empresarepository',
			'direccionrepository'
		];
	}
}
