<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use GrahamCampbell\BootstrapCMS\Facades\PedidoRepository;
use GrahamCampbell\BootstrapCMS\Models\Order;
use Illuminate\Support\Facades\View;

class PedidoController extends AbstractController {

    /**
     * Create a new instance.
     */
    public function __construct()
    {
        $this->setPermissions([
            'create'  => 'edit',
            'store'   => 'edit',
            'edit'    => 'edit',
            'update'  => 'edit',
            'destroy' => 'edit',
        ]);

        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $pedido = PedidoRepository::paginate();

        $producto = Order::all();

        return View::make('pedidos.index', ['pedido' => $pedido,'producto'=>$producto]);
    }
}