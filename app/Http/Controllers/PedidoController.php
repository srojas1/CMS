<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use GrahamCampbell\BootstrapCMS\Facades\PedidoRepository;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PedidoController extends AbstractController {

    /**
     * Create a new instance.
     */
    public function __construct()
    {
//        $this->setPermissions([
//            'create'  => 'edit',
//            'store'   => 'edit',
//            'edit'    => 'edit',
//            'update'  => 'edit',
//            'destroy' => 'edit',
//        ]);
//
//        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $pedido = PedidoRepository::paginate();

        return View::make('pedidos.index', ['pedido' => $pedido]);
    }

    public function changeStatus() {

        $id = $_POST['id_pedido'];
        $idEstado = $_POST['id_estado'];

        $pedido = PedidoRepository::find($id);
        $this->checkPedido($pedido);

        $input = ['id_estado'=>$idEstado];

        $pedido->update($input);
    }

    protected function checkPedido($pedido)
    {
        if (!$pedido) {
            throw new NotFoundHttpException('Pedido No Encontrado');
        }
    }
}