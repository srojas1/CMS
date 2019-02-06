<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;


use GrahamCampbell\BootstrapCMS\Models\Category;
use GrahamCampbell\BootstrapCMS\Models\Product;
use Illuminate\Http\Request;

class APIController extends AbstractController{

	public function GetProductos(){
		$data = Product::all();
		return response()->json($data);
	}
	
	public function GetCategorias() {
		$data = Category::all();
		return response()->json($data);
	}
	
	public function AddCategoria(Request $request) {
		$categoria = Category::create($request->all());
		return $categoria;
	}
}