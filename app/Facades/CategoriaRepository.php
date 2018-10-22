<?php

namespace GrahamCampbell\BootstrapCMS\Facades;

use Illuminate\Support\Facades\Facade;


class CategoriaRepository extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string|void
     */
    protected static function getFacadeAccessor()
    {
        return 'categoriarepository';
    }
}