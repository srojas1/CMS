<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use Cartalyst\Sentry\Users\Eloquent\User;
use GrahamCampbell\BootstrapCMS\Facades\ClienteRepository;
use GrahamCampbell\BootstrapCMS\Models\Empresa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use GrahamCampbell\BootstrapCMS\Models\Categoria;
use GrahamCampbell\BootstrapCMS\Models\Cliente;
use GrahamCampbell\BootstrapCMS\Models\Producto;
use Illuminate\Http\Request;

class APIController extends AbstractController{

	public function RegistrarCliente() {

		$user = Input::only('email');
		$pwd  = Input::only('password');
		$clienteEmpresaId  = Input::only('cliente_empresa_id');

		$input['email'] = $user['email'];
		$input['password'] = password_hash($pwd['password'],PASSWORD_DEFAULT);
		$input['cliente_empresa_id'] = $clienteEmpresaId['cliente_empresa_id'];

		$cliente = ClienteRepository::create($input);

		if($cliente) {
			$return['estado']  = true;
			$return['mensaje'] = "Usuario registrado exitosamente";
			$return['data'] = $cliente->email;
		}

		return response()->json($return);
	}

	public function ValidarCliente() {
		
		$user = Input::only('email');
		$pwd  = Input::only('password');
		$clienteEmpresaId  = Input::only('cliente_empresa_id');

		$matchCredentials = ['email' => $user,'cliente_empresa_id'=>$clienteEmpresaId];
		$columns          = ['id','email','password','nombres','apaterno','amaterno'];

		$validateClient   = Cliente::where($matchCredentials)->select($columns)->first();

		if ($validateClient && Hash::check($pwd['password'], $validateClient->password)) {
			$return['estado']  = true;
			$return['mensaje'] = "Usuario encontrado satisfactoriamente";
			$responseArr = $validateClient->toArray();
			//remove pwd from the response
			unset($responseArr['password']);
			$user = new User();
			$token = ["token"=>$user->getRandomString()];
			$responseArr = array_merge($responseArr,$token);
			$return['data']    = $responseArr;
		} else {
			$return['estado']  = false;
			$return['mensaje'] = "Usuario no encontrado";
			$return['data']    = array();
		}

		return response()->json($return);
	}

	public function GetUsuarios($idEmpresa) {
		$usuarios = \GrahamCampbell\BootstrapCMS\Models\User::where($idEmpresa)->get()->toArray();
		return $usuarios;
	}

	public function GetRecordsByModel($model, $idEmpresa) {
		$returnData = array();
		$usuarios = $this->GetUsuarios($idEmpresa);

		//recorro cada usuario y obtengo los productos x usuario
		foreach($usuarios as $nkey=>$us) {
			$matchUsuario = ['id_usuario'=> $us['id']];
			$data = $model::where($matchUsuario)->get();
			if($data)
				$data->toArray();

			//meto en un array los que encuentre
			$returnData[] = $data;
		}

		return $returnData;
	}

	public function GetProductos(){
		//set response data
		$return['estado'] = false;
		$return['mensaje'] = "Lista de productos no encontrada";

		//get records by model and id_empresa
		$returnData = $this->GetRecordsByModel(Producto::class, Input::only('usuario_empresa_id'));

		//si el array esta lleno, mando mensaje de exito y lleno data
		if(count($returnData)>0) {
			$return['estado'] = true;
			$return['mensaje'] = "Lista de productos encontrada";
			$return['data'] = $returnData;
		}

		return response()->json($return);
	}
	
	public function GetCategorias() {

		$return['estado'] = false;
		$return['mensaje'] = "Lista de categorías no encontrada";

		$returnData = $this->GetRecordsByModel(Categoria::class, Input::only('usuario_empresa_id'));

		if(count($returnData)>0) {
			$return['estado'] = true;
			$return['mensaje'] = "Lista de categorías encontrada";
			$return['data'] = $returnData;
		}

		return response()->json($return);
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