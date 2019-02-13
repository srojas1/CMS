<?php

namespace GrahamCampbell\BootstrapCMS\Models;

use GrahamCampbell\Credentials\Models\AbstractModel;
use GrahamCampbell\Credentials\Models\Relations\BelongsToUserTrait;
use GrahamCampbell\Credentials\Models\Relations\RevisionableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use McCool\LaravelAutoPresenter\HasPresenter;

class Cliente extends AbstractModel implements HasPresenter {

	use BelongsToUserTrait, RevisionableTrait, SoftDeletes;
	/**
	 * The table the events are stored in.
	 *
	 * @var string
	 */
	protected $table = 'cliente';

	/**
	 * The model name.
	 *
	 * @var string
	 */
	public static $name = 'cliente';

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
	protected $keepRevisionOf = ['nombres'];

	/**
	 * The columns to select when displaying an index.
	 *
	 * @var array
	 */
	public static $index = ['id','cliente_empresa_id',
		'nombres','apaterno','amaterno','puntos','last_login','movil',
		'fecha_nacimiento','puntos','email','documento','ranking','imagen_principal',
		'created_at'];

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
	 * The direction to order by when displaying an index.*
	 * @var string
	 */
	public static $sort = 'asc';

	/**
	 * The event validation rules.
	 *
	 * @var array
	 */
	public static $rules = [
		'nombres'    => 'required'
	];

	/**
	 * Get the presenter class.
	 *
	 * @return string
	 */
	public function getPresenterClass()
	{
		return 'GrahamCampbell\BootstrapCMS\Presenters\ClientPresenter';
	}

	public function address(){
		return $this->hasMany(Direccion::class);
	}

	public function orders(){
		return $this->hasMany(Orden::class);
	}

	public function lastOrder() {
		return $this->hasOne(Orden::class)->orderBy('fecha_compra', 'desc');
	}

	public function getPaymentCard() {
		return $this->hasMany(ClienteTipoPago::class);
	}

//	public function getCuponById() {
//		return $this->belongsToMany(Cupon::class,'cupon_client')->withPivot('id','deleted_at');
//	}

	public function getUserById() {
		return $this->hasOne(User::class,'id','id_usuario');
	}
}