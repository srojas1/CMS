<?php

namespace GrahamCampbell\BootstrapCMS\Facades;

use Illuminate\Support\Facades\Facade;

class EmpresaRepository extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'empresarepository';
    }
}