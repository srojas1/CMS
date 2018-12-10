<?php

namespace GrahamCampbell\BootstrapCMS\Models;

use GrahamCampbell\Credentials\Models\AbstractModel;
use GrahamCampbell\Credentials\Models\Relations\BelongsToUserTrait;
use GrahamCampbell\Credentials\Models\Relations\RevisionableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use McCool\LaravelAutoPresenter\HasPresenter;

class Order extends AbstractModel implements HasPresenter {

    use BelongsToUserTrait, RevisionableTrait, SoftDeletes;
    /**
     * The table the events are stored in.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The model name.
     *
     * @var string
     */
    public static $name = 'order';

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
    public static $index =
        ['id',
         'client_id',
         'total',
         'contacto_entrega',
         'movil_contacto_entrega',
         'id_estado',
         'fecha_pedido',
         'fecha_compra',
         'id_cliente_tipo_pago',
         'id_direccion'
        ];

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
        return $this->hasOne(Client::class,'id','client_id');
    }

    /**
     * Get Status by Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getStatusById() {
        return $this->hasOne(Status::class,'id','id_estado');
    }

    public function getProductsById() {
        return $this->belongsToMany(Product::class,
            'orders_products',
            'order_id',
            'product_id');
    }

    public function getPaymentCardByIdClient() {
        return $this->hasOne(ClientPaymentCard::class,'id','id_cliente_tipo_pago');
    }

    public function getAddressById() {
        return $this->hasOne(Address::class,'id','id_direccion');
    }
}