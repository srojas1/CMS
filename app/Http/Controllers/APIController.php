<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;


use GrahamCampbell\BootstrapCMS\Models\Categoria;
use GrahamCampbell\BootstrapCMS\Models\Producto;
use Illuminate\Http\Request;

class APIController extends AbstractController{

	public function GetProductos(){
		$data = Producto::all();
		return response()->json($data);
	}
	
	public function GetCategorias() {
		$data = Categoria::all();
		return response()->json($data);
	}
	
	public function AddCategoria(Request $request) {
		$categoria = Categoria::create($request->all());
		return $categoria;
	}
}