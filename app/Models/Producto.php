<?php

namespace GrahamCampbell\BootstrapCMS\Models;

use GrahamCampbell\Credentials\Models\AbstractModel;
use GrahamCampbell\Credentials\Models\Relations\BelongsToUserTrait;
use GrahamCampbell\Credentials\Models\Relations\RevisionableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use McCool\LaravelAutoPresenter\HasPresenter;

class Producto extends AbstractModel implements HasPresenter {

	use BelongsToUserTrait, RevisionableTrait, SoftDeletes;
	/**
	 * The table the events are stored in.
	 *
	 * @var string
	 */
	protected $table = 'producto';

	/**
	 * The model name.
	 *
	 * @var string
	 */
	public static $name = 'producto';

	/**
	 * The properties on the model that are dates.
	 *
	 * @var array
	 */
	protected $dates = ['created_at','updated_at','deleted_at'];

	/**
	 * The revisionable columns.
	 *
	 * @var array
	 */
	protected $keepRevisionOf = ['producto'];

	/**
	 * The columns to select when displaying an index.
	 *
	 * @var array
	 */
	public static $index = ['id','producto','codigo','descripcion','id_categoria','id_stock','precio','oferta','imagen','imagen_principal','vinculacion','visibilidad','SKU','id_usuario'];

	/**
	 * The max events per page when displaying a paginated index.
	 *
	 * @var int
	 */
	public static $paginate = 10;


	/**
	 * The model name.
	 *
	 * @var string
	 */
	public static $page_name = 'producto';

	/**
	 * The columns to order by when displaying an index.
	 *
	 * @var string
	 */
	public static $order = 'id';

	/**
	 * The direction to order by when displaying an index.
	 *
	 * @var string
	 */
	public static $sort = 'asc';

	/**
	 * The event validation rules.
	 *
	 * @var array
	 */
	public static $rules = [
		'producto'    => 'required'
	];

	/**
	 * Get the presenter class.
	 *
	 * @return string
	 */
	public function getPresenterClass()
	{
		return 'GrahamCampbell\BootstrapCMS\Presenters\ProductPresenter';
	}

	/**
	 * Get Categoria by Product
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function getCategoryById() {
		return $this->hasOne(Categoria::class,'id','id_categoria');
	}

	public function orders() {
		return $this->belongsToMany(Orden::class,'orden_producto')->withPivot('cantidad');
	}

	public function getCurrencyById() {
		return $this->hasOne(Currency::class,'id','id_moneda');
	}

	public function getAttributesById() {
		return $this->belongsToMany(Attribute::class,'atributo_producto')->withPivot('valor','id','deleted_at');
	}

	public function getUserById() {
		return $this->hasOne(User::class,'id','id_usuario');
	}

}
