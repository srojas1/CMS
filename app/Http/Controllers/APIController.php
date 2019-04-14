<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use Cartalyst\Sentry\Users\Eloquent\User;
use GrahamCampbell\BootstrapCMS\Facades\ClienteRepository;
use GrahamCampbell\BootstrapCMS\Facades\PedidoProductoRepository;
use GrahamCampbell\BootstrapCMS\Facades\PedidoRepository;
use GrahamCampbell\BootstrapCMS\Facades\DireccionRepository;
use GrahamCampbell\BootstrapCMS\Models\Atributo;
use GrahamCampbell\BootstrapCMS\Models\AtributoProducto;
use GrahamCampbell\BootstrapCMS\Models\Cupon;
use GrahamCampbell\BootstrapCMS\Models\CuponCliente;
use GrahamCampbell\BootstrapCMS\Models\Direccion;
use GrahamCampbell\BootstrapCMS\Models\Empresa;
use GrahamCampbell\BootstrapCMS\Models\Estado;
use GrahamCampbell\BootstrapCMS\Models\OrdenProducto;
use GrahamCampbell\BootstrapCMS\Models\Promo;
use GrahamCampbell\BootstrapCMS\Models\Orden;
use GrahamCampbell\BootstrapCMS\Models\Status;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use GrahamCampbell\BootstrapCMS\Models\Categoria;
use GrahamCampbell\BootstrapCMS\Models\Cliente;
use GrahamCampbell\BootstrapCMS\Models\Producto;
use League\Flysystem\Exception;
use Request;

class APIController extends AbstractController{
	
	public function ValidarCuponByCliente()
	{
		$return['estado'] = false;
		$return['mensaje'] = "Lista de cupones no encontrada";
		$returnArr = array();
		
		$clienteid = Input::only('cliente_id');
		$codigo = Input::only('codigo');
		
		$match = ['cliente_id' => $clienteid['cliente_id']];
		
		//get records by model and id_empresa
		$returnData = CuponCliente::where($match)->select('*')->get();
		$returnData = $returnData->ToArray();
		
		foreach($returnData as $data) {
			if(!empty($data['cupon_id'])) {
				$cuponId = $data['cupon_id'];
				$match2 = ['id'=>$cuponId];
				$returnData2 = Cupon::where($match2)->select('*')->first();
				$returnData2 = $returnData2->ToArray();
				if($returnData2['cupon'] == $codigo['codigo']) {
					$returnArr[] = $returnData2;
				}
			}
		}
		
		//si el array esta lleno, mando mensaje de exito y lleno data
		if(count($returnArr)>0) {
			$return['estado'] = true;
			$return['mensaje'] = "Lista de cupones por codigo encontrada";
			$return['data'] = $returnArr;
		}
		
		return response()->json($return);
	}
	
	public function GetPedidos(){
		//set response data
		$return['estado'] = false;
		$return['mensaje'] = "Lista de pedidos no encontrada";
		$returnArr = array();

		$clienteid = Input::only('cliente_id');

		$match = ['cliente_id' => $clienteid['cliente_id']];

		//get records by model and id_empresa
		$returnData = Orden::where($match)->select('*')->get();
		$returnData = $returnData->ToArray();

		foreach($returnData as $ret) {
			$arrRetProd = array();
			$idEstado =$ret['id_estado'];
			$matchEstado = ['id' => $idEstado];
			$returnEstado = Estado::where($matchEstado)->select('*')->first();
			$returnEstado = $returnEstado->ToArray();
			if($returnEstado['status_label_extra']!='') {
				$detalleEstado = $returnEstado['estado'].' '.$returnEstado['status_label_extra'];
			}
			else {
				$detalleEstado = $returnEstado['estado'];
			}
			$ret['estado_detalle'] = $detalleEstado;
			
			$idPedido = $ret['id'];
			$matchPedido = ['orden_id'=>$idPedido];
			$returnPedidoDetalle = OrdenProducto::where($matchPedido)->get()->ToArray();
			
			foreach($returnPedidoDetalle as $retPedDetalle) {
				$idProducto = $retPedDetalle['producto_id'];
				$matchProducto = ['id'=>$idProducto];
				$returnProducto = Producto::where($matchProducto)->get()->ToArray();
				$arrRetProd[] = $returnProducto;
			}
			
			$ret['producto_detalle'] = $arrRetProd;
			
			$returnArr[] = $ret;
		}

		//si el array esta lleno, mando mensaje de exito y lleno data
		if(count($returnArr)>0) {
			$return['estado'] = true;
			$return['mensaje'] = "Lista de pedidos encontrada";
			$return['data'] = $returnArr;
		}

		return response()->json($return);
	}

	public function EliminarDireccion() {

		$direccionId = Input::only('id_direccion');

		$direccion = DireccionRepository::find($direccionId['id_direccion']);

		if (!$direccion) {
			$return['estado']  = false;
			$return['mensaje'] = "No se pudo eliminar direccion. Direccion no existente";
			return response()->json($return);
		}

		try {
			$direccion->delete();
			$return['estado']  = true;
			$return['mensaje'] = "Direccion eliminada exitosamente";
		} catch (QueryException $e){
			$return['estado']  = false;
			$return['mensaje'] = "No se pudo eliminar direccion";
		}

		return response()->json($return);
	}

	public function RegistrarDireccion() {

		$clienteId = Input::only('cliente_id');
		$direccion = Input::only('direccion');
		$numero_detalles = Input::only('numero_detalles');
		$referencia = Input::only('referencia');

		$input['cliente_id'] = $clienteId['cliente_id'];
		$input['direccion'] = $direccion['direccion'];
		$input['numero_detalles'] = $numero_detalles['numero_detalles'];
		$input['referencia'] = $referencia['referencia'];

		try {
			$direccion = DireccionRepository::create($input);
			$responseArr['id'] = $direccion->id;
			$responseArr['direccion'] = $direccion->direccion;

			if(!$direccion) {
				$return['estado']  = false;
				$return['mensaje'] = "No se pudo registrar direccion";
				$return['data'] = array();
			}
			else {
				$return['estado']  = true;
				$return['mensaje'] = "Direccion registrada exitosamente";
				$return['data'] = $responseArr;
			}

		}
		catch (QueryException $e) {
			$return['estado']  = false;
			$return['mensaje'] = "No se pudo registrar direccion";
		}

		return response()->json($return);
	}

	public function GetRecomendados() {
		$returnArr = array();

		$return['estado'] = false;
		$return['mensaje'] = "Lista de recomendados no encontrada";
		$return['data'] = $returnArr;

		$idProducto = Input::only('id_producto');
		$match = ['id' => $idProducto['id_producto']];

		$modelProducto = Producto::where($match)->first();
		
		if(!$modelProducto) {
			$return['estado'] = false;
			$return['mensaje'] = "El producto no existe";
			return response()->json($return);
		}
		$modelProducto = $modelProducto->ToArray();
		$recomendados = $modelProducto['vinculacion'];
		$recomendados = json_decode($recomendados);
		
		//TODO: mejorar esto (para captar correctamente el id y para que no se repitan
		for($i=0;$i<3;$i++) {
			if(!isset($recomendados[$i])) {
				$rec = rand(23,count($modelProducto));
			} else {
				$rec = $recomendados[$i];
			}
			$matchRec = ['id' => $rec];
			$modelProductoRec[] = Producto::where($matchRec)->first()->toArray();
		}

		if($modelProductoRec) {
			foreach($modelProductoRec as $data) {
				$img = Request::url();
				$trimmed = str_replace('get_recomendados', '', $img) ;
				$imagenPrincipal = $trimmed.'images/'.json_decode($data['imagen_principal'])[0];
				$data['imagen_principal'] = $imagenPrincipal;
				$returnArr[]=$data;
			}
		}

		if(count($returnArr)>0) {
			$return['estado'] = true;
			$return['mensaje'] = "Lista de recomendados encontrada";
			$return['data'] = $returnArr;
		}

		return response()->json($return);
	}

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

	public function crearPedido()
	{
		$return['estado'] = false;
		$return['mensaje'] = "Problema al crear pedido";
		
		$arrAtr = array();
		$detailPed2 = array();
		$requestProducto = Input::all();
		$input['cliente_id'] = $requestProducto['cliente_id'];
		$input['id_direccion'] = $requestProducto['direccion_id'];
		$input['contacto_entrega'] = $requestProducto['contacto'];
		$input['movil_contacto_entrega'] = $requestProducto['celular'];
		$input['id_cliente_tipo_pago'] = $requestProducto['forma_pago'];
		$input['subtotal'] = $requestProducto['subtotal'];
		$input['total'] = $requestProducto['total'];
		$input['monto_efectivo'] = $requestProducto['monto_efectivo'];
		$returnData = array();

		$pedido = PedidoRepository::create($input);

		$productosDataArray[] = json_decode($requestProducto['productos_data'], true);

		foreach ($productosDataArray as $nkey => $pdata) {
			$productoId = $pdata['productos'][$nkey]['producto_id'];
			$productoAtributoId = $pdata['productos'][$nkey]['producto_atributo_id'];
			$cantidad = $pdata['productos'][$nkey]['cantidad'];

			$inputDetail['producto_id'] = $productoId;
			$inputDetail['cantidad'] = $cantidad;
			$inputDetail['orden_id'] = $pedido->id;

			$matchProducto = ['id' => $productoId];

			$producto = Producto::where($matchProducto)->select('*')->get();

			if($producto->isEmpty()) {
				$return['estado'] = false;
				$return['mensaje'] = "No se encontro producto con ese ID";
				return response()->json($return);
				exit;
			} else {
				$producto = $producto->ToArray();
			}
			
			//LISTA DE ATRIBUTOS
			$atributoProductoArray = $this->GetAtributoPorProducto($productoId);

			//TABLA PEDIDO DETALLE
			foreach ($productoAtributoId as $p) {
				$inputDetail['producto_atributo_id'] = $p;
				try {
					$pedidoDetail = PedidoProductoRepository::create($inputDetail);
					$pedidoDetailArr[] = $pedidoDetail->ToArray();
				}
				catch(Exception $ex) {
					$return['estado'] = false;
					$return['mensaje'] = "Hubo un problema al crear en la tabla Orden Producto";
					exit;
				}
			}
			
			foreach($pedidoDetailArr as $detailPed) {
				foreach($atributoProductoArray as $atr) {
					if($detailPed['producto_atributo_id'] == $atr['id_atributo_seleccionado']) {
						$arrAtr[] = $atr;
					}
					else
						continue;
				}
			}
			if($arrAtr)
				$detailPed2['atributos'] = $arrAtr;
			
			if(!count($detailPed2)>0)
				$returnData[] = array_merge($detailPed2,$producto);
			else {
				$return['estado'] = false;
				$return['mensaje'] = "Pedido creado fallo";
				return response()->json($return);
			}
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
		$columns = ['id','producto','descripcion','imagen_principal','precio'];

		$producto = Producto::where($match)->select($columns)->get();
		$producto = $producto->ToArray();

		foreach($producto as $nkey=>$rData) {
			$atributoProductoArray = $this->GetAtributoPorProducto($rData['id']);
			$returnProducto[] = array_merge($rData,array('atributos'=>$atributoProductoArray));
		}

		//si el array esta lleno, mando mensaje de exito y lleno data
		if(count($producto)>0) {
			$return['estado'] = true;
			$return['mensaje'] = "Lista de productos encontrada";
			$return['data'] = $returnProducto;
		}

		return response()->json($return);
	}

	public function ListarPromocionesImagen() {
		$return['estado'] = false;
		$return['mensaje'] = "Lista de promociones no encontrada";

		$returnData = $this->GetRecordsByModel(Promo::class, Input::only('usuario_empresa_id'));

		foreach($returnData as $nkey=>$retDat) {
			if(!empty($retDat)) {
				foreach ($retDat as $rd) {
					$img = Request::url();
					$trimmed = str_replace('listar_promociones_imagen', '', $img);
					
					$imagenPrincipal = $trimmed . 'images/' . json_decode($rd['imagen_principal'], 1)[0];
					$imagArr[] = $imagenPrincipal;
				}
			}
			else {
				continue;
			}
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