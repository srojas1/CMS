<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use GrahamCampbell\Binput\Facades\Binput;
use GrahamCampbell\BootstrapCMS\Facades\AtributoRepository;
use GrahamCampbell\Credentials\Facades\Credentials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AtributoController extends AbstractController {

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
        $atributo = AtributoRepository::paginate();

        return View::make('atributos.index', ['atributo'=>$atributo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return View::make('atributos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $input = array_merge(['user_id' => Credentials::getuser()->id], Binput::only([
            'atributo'
        ]));

        $val = AtributoRepository::validate($input, array_keys($input));

        if ($val->fails()) {
            return Redirect::route('atributo.create')->withInput()->withErrors($val->errors());
        }

        $atributo = AtributoRepository::create($request->all());

        return Redirect::route('atributo.show', ['atributo'=>$atributo->id])
            ->with('success', trans('messages.atributo.store_success'));
    }

    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function show()
    {
        $atributo = AtributoRepository::paginate();

        return View::make('atributos.show', ['atributo' => $atributo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $atributo = AtributoRepository::find($id);
        $this->checkAttribute($atributo);

        return View::make('atributos.edit', ['atributo' => $atributo]);
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
        $input = Binput::only(['atributo']);

        $val = $val = AtributoRepository::validate($input, array_keys($input));
        if ($val->fails()) {
            return Redirect::route('atributo.edit', ['atributo' => $id])->withInput()->withErrors($val->errors());
        }

        $atributo = AtributoRepository::find($id);
        $this->checkAttribute($atributo);

        $atributo->update($input);

        return Redirect::route('atributo.show', ['atributo' => $atributo->id])
            ->with('success', trans('messages.atributo.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $atributo = AtributoRepository::find($id);
        $this->checkAttribute($atributo);

        $atributo->delete();

        return Redirect::route('atributo.index')
            ->with('success', trans('messages.atributo.delete_success'));
    }

    /**
     * Check the client model.
     *
     * @param mixed $atributo
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return void
     */
    protected function checkAttribute($atributo)
    {
        if (!$atributo) {
            throw new NotFoundHttpException('Atributo No Encontrado');
        }
    }
}
