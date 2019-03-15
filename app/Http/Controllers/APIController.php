<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use Cartalyst\Sentry\Users\Eloquent\User;
use GrahamCampbell\BootstrapCMS\Facades\ClienteRepository;
use GrahamCampbell\BootstrapCMS\Facades\PedidoProductoRepository;
use GrahamCampbell\BootstrapCMS\Facades\PedidoRepository;
use GrahamCampbell\BootstrapCMS\Models\Atributo;
use GrahamCampbell\BootstrapCMS\Models\AtributoProducto;
use GrahamCampbell\BootstrapCMS\Models\Cupon;
use GrahamCampbell\BootstrapCMS\Models\CuponCliente;
use GrahamCampbell\BootstrapCMS\Models\Direccion;
use GrahamCampbell\BootstrapCMS\Models\Empresa;
use GrahamCampbell\BootstrapCMS\Models\Promo;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use GrahamCampbell\BootstrapCMS\Models\Categoria;
use GrahamCampbell\BootstrapCMS\Models\Cliente;
use GrahamCampbell\BootstrapCMS\Models\Producto;
use Request;
use League\Flysystem\Exception;

class APIController extends AbstractController{

	public function GetCuponByCliente() {
		$return['estado'] = false;
		$return['mensaje'] = "Lista de cupones encontrada";

		$clienteid = Input::only('cliente_id');

		$match = ['cliente_id' => $clienteid['cliente_id']];

		//get records by model and id_empresa
		$returnData = CuponCliente::where($match)->select('*')->get();

		foreach($returnData as $data) {
			$matchCupon = ['id' => $data['id']];
			$cupon = Cupon::where($matchCupon)->first();
			$cuponArray[] = $cupon->toArray();
		}

		//si el array esta lleno, mando mensaje de exito y lleno data
		if(count($returnData)>0) {
			$return['estado'] = true;
			$return['mensaje'] = "Lista de cupones encontrada";
			$return['data'] = $cuponArray;
		}

		return response()->json($return);
	}

	public function crearPedido() {
		$return['estado'] = false;
		$return['mensaje'] = "Problema al crear pedido";

		$requestProducto = Input::all();
		$input['cliente_id'] = $requestProducto['cliente_id'];

		$pedido = PedidoRepository::create($input);

		$productosDataArray[] = json_decode($requestProducto['productos_data'],true);

		foreach($productosDataArray as $nkey=>$pdata) {
			$productoId = $pdata['productos']['producto_id'];
			$productoAtributoId = $pdata['productos']['producto_atributo_id'];
			$cantidad = $pdata['productos']['cantidad'];

			$inputDetail['producto_id'] = $productoId;
			$inputDetail['producto_atributo_id'] = $productoAtributoId;
			$inputDetail['cantidad'] = $cantidad;
			$inputDetail['orden_id'] = $pedido->id;
			//pedido detail
			$pedidoDetail = PedidoProductoRepository::create($inputDetail);
			$pedidoDetail = $pedidoDetail->ToArray();
			//producto detail
			$matchProducto = ['id' => $pedidoDetail['producto_id']];
			$producto = Producto::where($matchProducto)->first();
			$producto = $producto->ToArray();
			//atributo detail
			$atributoProductoArray = $this->GetAtributoPorProducto($producto['id']);
			$atributoProductoList = array();

			foreach($atributoProductoArray as $atributoProd) {
				$matchAtributo = ['id' => $atributoProd['id_atributo_seleccionado']];
				$atributoProductoList = AtributoProducto::where($matchAtributo)->first();
				$atributoProductoList = $atributoProductoList->ToArray();
			}

			$returnData[] = array_merge($producto,$pedidoDetail,$atributoProductoList);
		}

		if(count($pedido)>0) {
			$return['estado'] = true;
			$return['mensaje'] = "Pedido creado exitosamente";
			$return['data'] = $returnData;
		}

		return response()->json($return);
	}

	public function GetDireccionesByCliente(){
		//set response data
		$return['estado'] = false;
		$return['mensaje'] = "Lista de direcciones no encontrada";

		$clienteid = Input::only('cliente_id');

		$match = ['cliente_id' => $clienteid['cliente_id']];

		//get records by model and id_empresa
		$returnData = Direccion::where($match)->select('*')->get();

		//si el array esta lleno, mando mensaje de exito y lleno data
		if(count($returnData)>0) {
			$return['estado'] = true;
			$return['mensaje'] = "Lista de direcciones encontrada";
			$return['data'] = $returnData->ToArray();
		}

		return response()->json($return);
	}

	public function CambiarPassword() {
		$return['estado'] = false;
		$return['mensaje'] = "No se pudo actualizar la contraseña";

		$idCliente      = Input::only('id');
		$passwordActual = Input::only('password_actual');
		$passwordNueva  = Input::only('password_nueva');

		$match = ['id' => $idCliente];
		$columns = ['id','email','password'];

		$cliente = Cliente::where($match)->select($columns)->first();

		if(Hash::check($passwordActual['password_actual'], $cliente->password)) {
			if(!Hash::check($passwordNueva['password_nueva'], $cliente->password)) {
				$input['password'] = password_hash($passwordNueva['password_nueva'],PASSWORD_DEFAULT);
				$cliente->update($input);

				$return['estado'] = true;
				$return['mensaje'] = "Se actualizó la contraseña correctamente";
				$return['data'] = $cliente;
			}
			else {
				$return['mensaje'] = "La contraseña actual no puede ser igual a la anterior";
			}
		}
		else{
			$return['mensaje'] = "La contraseña actual no es correcta";
		}

		return response()->json($return);

		//verifica si clave actual es la misma
		//si si... verifica que contraseña nueva no sea igual a la anterior
		//si no es igual... cambia la anterior contraseña x la nueva

	}

	public function GetProductosxCategoria(){
		//set response data
		$return['estado'] = false;
		$return['mensaje'] = "Lista de productos no encontrada";

		//get records by model and id_empresa
		$returnData = $this->GetRecordsByModel(Producto::class, Input::only('usuario_empresa_id'));

		$categoria_id = Input::only('categoria_id');

		$match = ['categoria_id' => $categoria_id];
		$columns = ['producto','descripcion','imagen_principal','precio'];

		$producto = Producto::where($match)->select($columns)->get();

		//si el array esta lleno, mando mensaje de exito y lleno data
		if(count($producto)>0) {
			$return['estado'] = true;
			$return['mensaje'] = "Lista de productos encontrada";
			$return['data'] = $producto;
		}

		return response()->json($return);
	}

	public function ListarPromocionesImagen() {
		$return['estado'] = false;
		$return['mensaje'] = "Lista de promociones no encontrada";

		$returnData = $this->GetRecordsByModel(Promo::class, Input::only('usuario_empresa_id'));
		$returnData = $returnData[0];

		foreach($returnData as $retDat) {
			$img = Request::url();
			$trimmed = str_replace('listar_promociones_imagen', '', $img) ;
			$imagenPrincipal = $trimmed.'images/'.json_decode($retDat['imagen_principal'])[0];
			$imagArr[]=$imagenPrincipal;
		}

		if(count($returnData)>0) {
			$return['estado'] = true;
			$return['mensaje'] = "Lista de promociones encontrada";
			$return['data'] = $imagArr;
		}

		return response()->json($return);
	}

	public function ActualizarDatosCliente() {

		$id = Input::only('id');
		$nombres = Input::only('nombres');
		$apaterno = Input::only('apaterno');
		$amaterno = Input::only('amaterno');
		$movil = Input::only('movil');
		$email = Input::only('email');
		$fecha_nacimiento = Input::only('fecha_nacimiento');

		$input['nombres'] = $nombres['nombres'];
		$input['apaterno'] = $apaterno['apaterno'];
		$input['amaterno'] = $amaterno['amaterno'];
		$input['movil'] = $movil['movil'];
		$input['email'] = $email['email'];
		$input['fecha_nacimiento'] = $fecha_nacimiento['fecha_nacimiento'];

		$match = ['id' => $id];
		$columns = ['id','email','nombres','apaterno','amaterno','movil','fecha_nacimiento'];

		$cliente = Cliente::where($match)->select($columns)->first();

		$cliente->update($input);

		$responseArr['nombres'] = $cliente->nombres;
		$responseArr['apaterno'] = $cliente->apaterno;
		$responseArr['amaterno'] = $cliente->amaterno;
		$responseArr['movil'] = $cliente->movil;
		$responseArr['email'] = $cliente->email;
		$responseArr['fecha_nacimiento'] = $cliente->fecha_nacimiento;

		if($cliente) {
			$return['estado']  = true;
			$return['mensaje'] = "Usuario modificado exitosamente";
			$return['data'] = $responseArr;
		}

		return response()->json($return);
	}

	public function RegistrarCliente() {

		$user = Input::only('email');
		$pwd  = Input::only('password');
		$clienteEmpresaId  = Input::only('cliente_empresa_id');

		$input['email'] = $user['email'];
		$input['password'] = password_hash($pwd['password'],PASSWORD_DEFAULT);
		$input['cliente_empresa_id'] = $clienteEmpresaId['cliente_empresa_id'];

		try {
			$cliente = ClienteRepository::create($input);
			$responseArr['id'] = $cliente->id;
			$responseArr['email'] = $cliente->email;

			if(!$cliente) {
				$return['estado']  = false;
				$return['mensaje'] = "No se pudo registrar usuario";
				$return['data'] = array();
			}
			else {
				$return['estado']  = true;
				$return['mensaje'] = "Usuario registrado exitosamente";
				$return['data'] = $responseArr;
			}

		}
		catch (QueryException $e) {
			$return['estado']  = false;
			$return['mensaje'] = "No se pudo registrar usuario";
		}

		return response()->json($return);
	}

	public function validarCliente() {
		$user = Input::only('email');
		$clienteEmpresaId  = Input::only('cliente_empresa_id');

		$matchCredentials = ['email' => $user,'cliente_empresa_id'=>$clienteEmpresaId];
		$columns          = ['id','email','nombres','apaterno','amaterno'];

		$validateClient   = Cliente::where($matchCredentials)->select($columns)->first();

		if(!$validateClient) {
			$return['estado']  = false;
			$return['mensaje'] = "Usuario no encontrado";
			$return['data']    = array();
		}
		else {
			$responseArr = $validateClient->toArray();
			$return['estado']  = true;
			$return['mensaje'] = "Usuario encontrado";
			$return['data']    = $responseArr['email'];
		}

		return response()->json($return);
	}

	public function ValidarClienteUsuarioPassword() {
		
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
			if($data) {
				$returnData[] =$data->toArray();
				//meto en un array los que encuentre
			}
		}

		return $returnData;
	}

	public function GetRecordsProdByModel($model, $idEmpresa) {
		$returnData = array();
		$usuarios = $this->GetUsuarios($idEmpresa);

		//recorro cada usuario y obtengo los productos x usuario
		foreach($usuarios as $nkey=>$us) {
			$matchUsuario = ['id_usuario'=> $us['id']];
			$data = $model::where($matchUsuario)->get()->ToArray();
			$returnData = array_merge($data,$returnData);
		}

		return $returnData;
	}

	public function GetAtributoPorProducto($productoId) {
		$matchAtributo = ['producto_id'=>$productoId];

		$atributoProducto = AtributoProducto::where($matchAtributo)->get()->toArray();

		foreach($atributoProducto as $nkey=>$aProd) {
			$atributoArray = Atributo::where('id',$aProd['atributo_id'])->first()->toArray();
			$atributo[$nkey]['atributo_label'] = $atributoArray['atributo'];
			$atributo[$nkey]['atributo_opciones'] = $atributoArray['valor'];
			$atributo[$nkey]['valor'] = $aProd['valor'];
			$atributo[$nkey]['id_atributo_seleccionado'] = $aProd['id'];
		}

		return $atributo;
	}

	public function GetProductos(){
		//set response data
		$return['estado'] = false;
		$return['mensaje'] = "Lista de productos no encontrada";

		//get records by model and id_empresa
		$returnData = $this->GetRecordsProdByModel(Producto::class, Input::only('usuario_empresa_id'));

		foreach($returnData as $nkey=>$rData) {
			$atributoProductoArray = $this->GetAtributoPorProducto($rData['id']);
			$returnProducto[] = array_merge($rData,array('atributos'=>$atributoProductoArray));
		}

		//si el array esta lleno, mando mensaje de exito y lleno data
		if(count($returnData)>0) {
			$return['estado'] = true;
			$return['mensaje'] = "Lista de productos encontrada";
			$return['data'] = $returnProducto;
		}

		return response()->json($return);
	}
	
	public function GetCategorias() {

		$return['estado'] = false;
		$return['mensaje'] = "Lista de categorías no encontrada";

		$returnData = $this->GetRecordsByModel(Categoria::class, Input::only('usuario_empresa_id'));

		$url = Request::url();
		$trimmed = str_replace('get_categorias', '', $url) ;

		foreach($returnData as $nkey=>$retDat) {
			if($retDat)
				$returnData = $returnData[$nkey];
		}

		foreach($returnData as $nkey=>$retDat) {
			$returnDataNew[$nkey]['id']=$retDat['id'];
			$returnDataNew[$nkey]['categoria']=$retDat['categoria'];
			$imagenPrincipal = $trimmed.'images/'.json_decode($retDat['imagen_principal'])[0];
			$returnDataNew[$nkey]['imagen_principal']=$imagenPrincipal;
			$returnDataNew[$nkey]['id_usuario']=$retDat['id_usuario'];
			$returnDataNew[$nkey]['created_at']=$retDat['created_at'];
			$returnDataNew[$nkey]['updated_at']=$retDat['updated_at'];
			$returnDataNew[$nkey]['deleted_at']=$retDat['deleted_at'];
		}

		if(count($returnData)>0) {
			$return['estado'] = true;
			$return['mensaje'] = "Lista de categorías encontrada";
			$return['data'] = $returnDataNew;
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