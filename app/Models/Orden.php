<?php

namespace GrahamCampbell\BootstrapCMS\Models;

use GrahamCampbell\Credentials\Models\AbstractModel;
use GrahamCampbell\Credentials\Models\Relations\BelongsToUserTrait;
use GrahamCampbell\Credentials\Models\Relations\RevisionableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use McCool\LaravelAutoPresenter\HasPresenter;

class Orden extends AbstractModel implements HasPresenter {

    use BelongsToUserTrait, RevisionableTrait, SoftDeletes;
    /**
     * The table the events are stored in.
     *
     * @var string
     */
    protected $table = 'orden';

    /**
     * The model name.
     *
     * @var string
     */
    public static $name = 'orden';

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
    protected $keepRevisionOf = ['id','id_direccion'];

    /**
     * The columns to select when displaying an index.
     *
     * @var array
     */
    public static $index =
		['id',
		 'cliente_id',
		 'id_direccion',
		 'id_estado',
		 'fecha_pedido',
		 'fecha_compra',
		 'subtotal',
		 'costo_envio',
		 'total',
		 'contacto_entrega',
		 'movil_contacto_entrega',
		 'id_forma_pago',
		 'id_pago_contraentrega_detalle',
		 'id_cliente_tarjeta',
		 'monto_efectivo'
		];

    /**
     * The max events per page when displaying a paginated index.
     *
     * @var int
     */
    public static $paginate = 100;

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
        'id'    => 'required'
    ];

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        return 'GrahamCampbell\BootstrapCMS\Presenters\OrderPresenter';
    }

    /**
     * Get Client by Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getClientById() {
        return $this->hasOne(Cliente::class,'id','cliente_id');
    }

    /**
     * Get Status by Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getStatusById() {
        return $this->hasOne(Estado::class,'id','id_estado');
    }

    public function getProductsById() {
        return $this->belongsToMany(Producto::class,
            'orden_producto',
            'orden_id',
            'producto_id');
    }

    public function getPaymentCardByIdClient() {
        return $this->hasOne(ClienteTarjeta::class,'id','id_cliente_tarjeta');
    }

    public function getAddressById() {
        return $this->hasOne(Direccion::class,'id','id_direccion');
    }

    public function getFormaPago() {
		return $this->hasOne(FormaPago::class,'id','id_forma_pago');
	}

	public function getPagoContraentregaDetalle() {
		return $this->hasOne(PagoContraentregaDetalle::class,'id','id_pago_contraentrega_detalle');
	}
}