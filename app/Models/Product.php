<?php

namespace GrahamCampbell\BootstrapCMS\Models;

use GrahamCampbell\Credentials\Models\AbstractModel;
use GrahamCampbell\Credentials\Models\Relations\BelongsToUserTrait;
use GrahamCampbell\Credentials\Models\Relations\RevisionableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use McCool\LaravelAutoPresenter\HasPresenter;

class Product extends AbstractModel implements HasPresenter {

	use BelongsToUserTrait, RevisionableTrait, SoftDeletes;
	/**
	 * The table the events are stored in.
	 *
	 * @var string
	 */
	protected $table = 'products';

	/**
	 * The model name.
	 *
	 * @var string
	 */
	public static $name = 'product';

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
	public static $index = ['id','producto','id_categoria','id_stock','precio','oferta','filename'];

	/**
	 * The max events per page when displaying a paginated index.
	 *
	 * @var int
	 */
	public static $paginate = 2;

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
     * Get Category by Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getCategoryById() {
        return $this->hasOne(Category::class,'id','id_categoria');
    }

    public function orders() {
        return $this->belongsToMany(Order::class,'orders_products');
    }

    public function getCurrencyById() {
        return $this->hasOne(Currency::class,'id','id_moneda');
    }

	public function getAttributesById() {
		return $this->belongsToMany(Attribute::class,'attributes_products')->withPivot('valor');
	}
}