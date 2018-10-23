<?php
/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 22/10/18
 * Time: 09:56 PM
 */

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
        return $this->hasMany('GrahamCampbell\BootstrapCMS\Models\Category');
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