<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;


use GrahamCampbell\BootstrapCMS\Models\Category;
use GrahamCampbell\BootstrapCMS\Models\Product;

class APIController extends AbstractController{

	public function ObtenerProductos(){
		$data = Product::all();
		return response()->json($data);
	}
	
	public function ObtenerCategorias() {
		$data = Category::all();
		return response()->json($data);
	}
}