<?php

namespace GrahamCampbell\BootstrapCMS\Facades;

use Illuminate\Support\Facades\Facade;

class DireccionRepository extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'direccionrepository';
    }
}