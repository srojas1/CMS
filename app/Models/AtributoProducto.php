<?php

namespace GrahamCampbell\BootstrapCMS\Models;

use GrahamCampbell\Credentials\Models\AbstractModel;
use GrahamCampbell\Credentials\Models\Relations\BelongsToUserTrait;
use GrahamCampbell\Credentials\Models\Relations\RevisionableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use McCool\LaravelAutoPresenter\HasPresenter;

class AtributoProducto extends AbstractModel implements HasPresenter {

	use BelongsToUserTrait, RevisionableTrait, SoftDeletes;
	/**
	 * The table the events are stored in.
	 *
	 * @var string
	 */
	protected $table = 'atributo_producto';

	/**
	 * The model name.
	 *
	 * @var string
	 */
	public static $name = 'atributoproducto';

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
	protected $keepRevisionOf = ['id'];

	/**
	 * The columns to select when displaying an index.
	 *
	 * @var array
	 */
	public static $index = ['id'];

	/**
	 * The max events per page when displaying a paginated index.
	 *
	 * @var int
	 */
	public static $paginate = 10;

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
	 * Get the presenter class.
	 *
	 * @return string
	 */
	public function getPresenterClass()
	{
		return 'GrahamCampbell\BootstrapCMS\Presenters\AttributeProductPresenter';
	}

}