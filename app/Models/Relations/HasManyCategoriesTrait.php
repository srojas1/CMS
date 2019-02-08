<?php

namespace GrahamCampbell\BootstrapCMS\Models\Relations;


trait HasManyCategoriesTrait
{
    /**
     * Get the event relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOneOrMany
     */
    public function categorias()
    {
        return $this->hasMany('GrahamCampbell\BootstrapCMS\Models\Categoria');
    }

    /**
     * Delete all events.
     *
     * @return void
     */
    public function deleteEvents()
    {
        foreach ($this->categorias()->get(['id']) as $categoria) {
            $categoria->delete();
        }
    }
}