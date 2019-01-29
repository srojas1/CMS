<?php

namespace GrahamCampbell\BootstrapCMS\Models;

use GrahamCampbell\Credentials\Models\AbstractModel;
use GrahamCampbell\Credentials\Models\Relations\BelongsToUserTrait;
use GrahamCampbell\Credentials\Models\Relations\RevisionableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use McCool\LaravelAutoPresenter\HasPresenter;

class Status extends AbstractModel implements HasPresenter {

    use BelongsToUserTrait, RevisionableTrait, SoftDeletes;
    /**
     * The table the events are stored in.
     *
     * @var string
     */
    protected $table = 'status';

    /**
     * The model name.
     *
     * @var string
     */
    public static $name = 'status';

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
    protected $keepRevisionOf = ['estado, status_detail','status_reject'];

    /**
     * The columns to select when displaying an index.
     *
     * @var array
     */
    public static $index = ['estado, status_detail','status_reject'];

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
        return 'GrahamCampbell\BootstrapCMS\Presenters\StatusPresenter';
    }

}