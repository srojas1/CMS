<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use GrahamCampbell\Binput\Facades\Binput;
use GrahamCampbell\BootstrapCMS\Facades\ClienteRepository;
use GrahamCampbell\Credentials\Facades\Credentials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ClienteController extends AbstractController
{
    /**
     * Create a new instance.
     *
     * @return void
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
        $cliente = ClienteRepository::paginate();

        return View::make('clientes.index', ['cliente' => $cliente]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $cliente = ClienteRepository::find($id);
        $this->checkClient($cliente);

        return View::make('clientes.edit', ['cliente' => $cliente]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $input = Binput::only(['cliente']);

        $val = $val = ClienteRepository::validate($input, array_keys($input));
        if ($val->fails()) {
            return Redirect::route('cliente.edit', ['cliente' => $id])->withInput()->withErrors($val->errors());
        }

        $cliente = ClienteRepository::find($id);
        $this->checkCategory($cliente);

        $cliente->update($input);

        return Redirect::route('cliente.show', ['cliente' => $cliente->id])
            ->with('success', trans('messages.cliente.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Check the category model.
     *
     * @param mixed $category
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return void
     */
    protected function checkClient($client)
    {
        if (!$client) {
            throw new NotFoundHttpException('Cliente No Encontrado');
        }
    }
}
