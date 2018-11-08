<?php
/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 21/10/18
 * Time: 10:59 PM
 */

namespace GrahamCampbell\BootstrapCMS\Repositories;

use GrahamCampbell\Credentials\Repositories\AbstractRepository;
use GrahamCampbell\Credentials\Repositories\PaginateRepositoryTrait;

class ClienteRepository extends AbstractRepository{

    use PaginateRepositoryTrait;
}