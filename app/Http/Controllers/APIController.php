<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use GrahamCampbell\BootstrapCMS\Models\Empresa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use GrahamCampbell\BootstrapCMS\Models\Categoria;
use GrahamCampbell\BootstrapCMS\Models\Client;
use GrahamCampbell\BootstrapCMS\Models\Producto;
use Illuminate\Http\Request;

class APIController extends AbstractController{

	public function ValidarCliente() {

		$user = Input::only('email');
		$pwd  = Input::only('password');
		$clienteEmpresaId  = Input::only('cliente_empresa_id');

		$matchCredentials = ['email' => $user,'cliente_empresa_id'=>$clienteEmpresaId];
		$columns          = ['id','email','password','nombres','apaterno','amaterno'];

		$validateClient   = Client::where($matchCredentials)->select($columns)->first();

		if ($validateClient && Hash::check($pwd['password'], $validateClient->password)) {
			$return['estado']  = true;
			$return['mensaje'] = "Usuario encontrado satisfactoriamente";
			$responseArr = $validateClient->toArray();
			//remove pwd from the response
			unset($responseArr['password']);
			$return['data']    = $responseArr;
		} else {
			$return['estado']  = false;
			$return['mensaje'] = "Usuario no encontrado";
			$return['data']    = array();
		}

		return response()->json($return);
	}

	public function GetProductos(){
		$data = Producto::all();
		$return['estado'] = false;
		$return['mensaje'] = "Lista de productos no encontrada";

		if($data) {
			$return['estado'] = true;
			$return['mensaje'] = "Lista de productos encontrada";
			$return['data'] = $data;
		}

		return response()->json($return);
	}
	
	public function GetCategorias() {
		$data = Categoria::all();
		$return['estado'] = false;
		$return['mensaje'] = "Lista de categorías no encontrada";

		if($data) {
			$return['estado'] = true;
			$return['mensaje'] = "Lista de categorías encontrada";
			$return['data'] = $data;
		}

		return response()->json($return);
	}
	
	public function AddCategoria(Request $request) {
		$categoria = Categoria::create($request->all());
		return $categoria;
	}

	public function GetEmpresas() {
		$data = Empresa::all();
		$return['estado'] = false;
		$return['mensaje'] = "Lista de empresas no encontrada";

		if($data) {
			$return['estado'] = true;
			$return['mensaje'] = "Lista de empresas encontrada";
			$return['data'] = $data;
		}

		return response()->json($return);
	}
}