<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use Cartalyst\Sentry\Users\Eloquent\User;
use GrahamCampbell\BootstrapCMS\Facades\ClienteRepository;
use GrahamCampbell\BootstrapCMS\Facades\PedidoProductoRepository;
use GrahamCampbell\BootstrapCMS\Facades\PedidoRepository;
use GrahamCampbell\BootstrapCMS\Facades\DireccionRepository;
use GrahamCampbell\BootstrapCMS\Http\Constants;
use GrahamCampbell\BootstrapCMS\Models\Atributo;
use GrahamCampbell\BootstrapCMS\Models\AtributoOpcion;
use GrahamCampbell\BootstrapCMS\Models\AtributoProducto;
use GrahamCampbell\BootstrapCMS\Models\Cupon;
use GrahamCampbell\BootstrapCMS\Models\CuponCliente;
use GrahamCampbell\BootstrapCMS\Models\Direccion;
use GrahamCampbell\BootstrapCMS\Models\Empresa;
use GrahamCampbell\BootstrapCMS\Models\Estado;
use GrahamCampbell\BootstrapCMS\Models\Moneda;
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
use Illuminate\Support\Facades\Request;
use League\Flysystem\Exception;

class APIController extends AbstractController{

	/**
	 * Cliente Login y registro
	 */
	
	public function ValidarClienteUsuarioPassword() {
		
		$user = Input::only('email');
		$pwd  = Input::only('password');
		$clienteEmpresaId  = Input::only('cliente_empresa_id');
		
		$matchCredentials = ['email' => $user,'cliente_empresa_id'=>$clienteEmpresaId];
		$columns          = ['id','email','password','nombres','apaterno','amaterno'];
		
		$validateClient   = Cliente::where($matchCredentials)->select($columns)->first();
		
		if(!$validateClient) {
			$return['estado']  = false;
			$return['mensaje'] = "Nombre de usuario incorrecto";
			$return['data']    = array();
			return response()->json($return);
		}
		
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
			$return['mensaje'] = "Contraseña incorrecta";
			$return['data']    = array();
		}
		
		return response()->json($return);
	}
	
	public function ValidarCliente() {
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
	
	public function CambiarPassword() {
		$return['estado'] = false;
		$return['mensaje'] = "No se pudo actualizar la contraseña";
		
		$idCliente      = Input::only('id');
		$passwordActual = Input::only('password_actual');
		$passwordNueva  = Input::only('password_nueva');
		
		$match = ['id' => $idCliente];
		$columns = ['id','email','password'];
		
		$cliente = Cliente::where($match)->select($columns)->first();
		
		//verifica si clave actual es la misma
		//si si... verifica que contraseña nueva no sea igual a la anterior
		//si no es igual... cambia la anterior contraseña x la nueva
		
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
		
		if(!$cliente) {
			$return['estado']  = false;
			$return['mensaje'] = "Cliente no encontrado";
			return response()->json($return);
		}
		
		$cliente->update($input);
		
		$responseArr['nombres'] = $cliente->nombres;
		$responseArr['apaterno'] = $cliente->apaterno;
		$responseArr['amaterno'] = $cliente->amaterno;
		$responseArr['movil'] = $cliente->movil;
		$responseArr['email'] = $cliente->email;
		$responseArr['fecha_nacimiento'] = $cliente->fecha_nacimiento;
		
		if($cliente) {
			$return['estado']  = true;
			$return['mensaje'] = "Cliente modificado exitosamente";
			$return['data'] = $responseArr;
		}
		
		return response()->json($return);
	}

	/**
	 * Categorias y productos
	 */
	
	public function GetCategorias() {
		
		$return['estado'] = false;
		$return['mensaje'] = "Lista de categorías no encontrada";
		
		$returnData = $this->GetRecordsByModel(Categoria::class, Input::only('usuario_empresa_id'));
		
		foreach($returnData as $nkey=>$retDat) {
			if($retDat)
				$returnData = $returnData[$nkey];
		}
		
		foreach($returnData as $nkey=>$retDat) {
			$returnDataNew[$nkey]['id']=$retDat['id'];
			$returnDataNew[$nkey]['categoria']=$retDat['categoria'];
			$imagenPrincipal = getFullURLImage('get_categorias').json_decode($retDat['imagen_principal'])[0];
			$returnDataNew[$nkey]['imagen_principal']=$imagenPrincipal;
		}
		
		if(count($returnData)>0) {
			$return['estado'] = true;
			$return['mensaje'] = "Lista de categorías encontrada";
			$return['data'] = $returnDataNew;
		}
		
		return response()->json($return);
	}
	
	public function GetProductos(){

		$return['estado'] = false;
		$return['mensaje'] = "Lista de productos no encontrada";
		
		//get records by model and id_empresa
		$returnData = $this->GetRecordsProdByModel(Producto::class, Input::only('usuario_empresa_id'));
		
		foreach($returnData as $nkey=>$rData) {
			$imagenPrincipal = getFullURLImage('get_productos').json_decode($rData['imagen_principal'])[0];
			
			$productosArr['id'] = $rData['id'];
			$productosArr['producto'] = $rData['producto'];
			$productosArr['descripcion'] = $rData['descripcion'];
			$productosArr['imagen_principal'] = $imagenPrincipal;
			$productosArr['precio'] = getMonedaSimbol($rData['id_moneda']).' '.$rData['precio'];
			
			$atributoProductoArray = $this->GetAtributoPorProducto($rData['id']);
			$returnProducto[] = array_merge($productosArr,array('atributos'=>$atributoProductoArray));
		}
		
		//si el array esta lleno, mando mensaje de exito y lleno data
		if(count($returnData)>0) {
			$return['estado'] = true;
			$return['mensaje'] = "Lista de productos encontrada";
			$return['data'] = $returnProducto;
		}
		
		return response()->json($return);
	}
	
	public function GetProductosxCategoria(){
		//set response data
		$return['estado'] = false;
		$return['mensaje'] = "Lista de productos no encontrada";
		
		$categoriaInput = Input::only('categoria_id');
		$categoriaId = $categoriaInput['categoria_id'];
		
		$match = ['categoria_id' => $categoriaId, 'visibilidad'=>Constants::OPTION_VALID];
		$columns = ['id','producto','descripcion','imagen_principal','precio','id_moneda'];
		
		$producto = Producto::orderBy('producto')->where($match)->select($columns)->get();
		$producto = $producto->ToArray();
		
		foreach($producto as $nkey=>$rData) {
			//$atributoProductoArray = $this->GetAtributoPorProducto($rData['id']);
			$atributoProductoArray = array();
			$imagenPrincipal = getFullURLImage('get_productos_categoria').json_decode($rData['imagen_principal'])[0];
			$rData['imagen_principal'] = $imagenPrincipal;
			$rData['precio'] = getMonedaSimbol($rData['id_moneda']).' '.$rData['precio'];
			
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
		
		for($i=0;$i<3;$i++) {
			if(!isset($recomendados[$i])) {
				//otra forma de obtener numeros random
				//$prod = Producto::orderByRaw("RAND()")->first();
				$prod = Producto::all()->random(1);
			} else {
				$rec = $recomendados[$i];
				$matchRec = ['id' => $rec];
				$prod = Producto::where($matchRec)->first();
			}
			
			$modelProductoRec[] = $prod->toArray();
		}
		
		if($modelProductoRec) {
			foreach($modelProductoRec as $data) {
				$productoArr['id'] = $data['id'];
				$productoArr['producto'] = $data['producto'];
				$productoArr['descripcion'] = $data['descripcion'];
				$imagenPrincipal = getFullURLImage('get_recomendados').json_decode($data['imagen_principal'])[0];
				$productoArr['imagen_principal'] = $imagenPrincipal;
				$productoArr['precio'] = getMonedaSimbol($data['id_moneda']).' '.$data['precio'];
				
				$atributoProductoArray = $this->GetAtributoPorProducto($data['id']);
				$returnArr[] = array_merge($productoArr,array('atributos'=>$atributoProductoArray));
			}
		}
		
		if(count($returnArr)>0) {
			$return['estado'] = true;
			$return['mensaje'] = "Lista de recomendados encontrada";
			$return['data'] = $returnArr;
		}
		
		return response()->json($return);
	}

	/**
	 * Promociones
	 */
	
	public function ListarPromocionesImagen() {
		$return['estado'] = false;
		$return['mensaje'] = "Lista de promociones no encontrada";
		
		$returnData = $this->GetRecordsByModel(Promo::class, Input::only('usuario_empresa_id'));
		
		foreach($returnData as $nkey=>$retDat) {
			if(!empty($retDat)) {
				foreach ($retDat as $rd) {
					
					$imagen = json_decode($rd['imagen_principal'], 1)[0];
					
					if($imagen == '') {
						$imagen = Constants::DEFAULT_IMAGE_NAME;
					}
					
					$imagenPrincipal = getFullURLImage('listar_promociones_imagen').$imagen;
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

	/**
	 * Direcciones
	 */
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

	/**
	 * Cupones
	 */
	
	public function GetCuponByCliente() {
		$return['estado'] = false;
		$return['mensaje'] = "Lista de cupones no encontrada";
		
		$clienteid = Input::only('cliente_id');
		
		$match = ['cliente_id' => $clienteid['cliente_id']];
		
		//get records by model and id_empresa
		$returnData = CuponCliente::where($match)->select('*')->get();
		
		foreach($returnData as $data) {
			$matchCupon = ['id' => $data['id']];
			$cupon = Cupon::where($matchCupon)->first();
			$cupon->descuento = getMonedaSimbol($cupon->moneda_id).' '.$cupon->descuento;
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
				$returnData2['descuento'] = getMonedaSimbol($returnData2['moneda_id']). ' '.$returnData2['descuento'];
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

	/**
	 * Pedidos (Ordenes)
	 */
	
	public function GetPedidos(){
		//set response data
		$return['estado'] = false;
		$return['mensaje'] = "Lista de pedidos no encontrada";
		$returnArr = array();

		$clienteid = Input::only('cliente_id');

		$match = ['cliente_id' => $clienteid['cliente_id']];

		//get records by model and id_empresa
		$returnData = Orden::orderBy('created_at','desc')->where($match)->select('*')->get();
		$returnData = $returnData->ToArray();

		foreach($returnData as $ret) {
			$detalleProducto = array();
			$cantidad = 1;
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
			
			foreach($returnPedidoDetalle as $nkey=>$retPedDetalle) {
				$idProducto = $retPedDetalle['producto_id'];
				$matchProducto = ['id'=>$idProducto];
				$returnProducto = Producto::where($matchProducto)->get()->ToArray();
				
				if(!empty($returnProducto)) {
					$idProductoModel = $returnProducto[0]['id'];
					$detalleProducto[$nkey]['cantidad'] = $cantidad;
					
					if(($idProductoModel === $idProducto) && $nkey!=0) {
						$cantidad++;
						$detalleProducto[$nkey]['cantidad'] = $cantidad;
					}
					
					$imagenPrincipal = getFullURLImage('get_pedidos') . json_decode($returnProducto[0]['imagen_principal'], 1)[0];

					$detalleProducto[$nkey]['imagen_principal'] = $imagenPrincipal;
					$detalleProducto[$nkey]['id_producto'] = $returnProducto[0]['id'];
					$detalleProducto[$nkey]['producto'] = $returnProducto[0]['producto'];
					$detalleProducto[$nkey]['descripcion'] = $returnProducto[0]['descripcion'];
					$detalleProducto[$nkey]['precio'] = getMonedaSimbol($returnProducto[0]['id_moneda']).' '.$returnProducto[0]['precio'];
					
					//Get Atributos
					$atributoProductoArray = $this->GetAtributoPorProductoPedido($idProductoModel,$idPedido);

					$detalleProducto[$nkey]['atributo_detalle'] = $atributoProductoArray;
				}
				else
					continue;
			}
			
			$ret['producto_detalle'] = $detalleProducto;

			$ret['id'] = $ret['id'];
			
			$ret['subtotal'] = getMonedaSimbol($ret['moneda_id']).' '.$ret['subtotal'];
			$ret['costo_envio'] = getMonedaSimbol($ret['moneda_id']).' '.$ret['costo_envio'];
			$ret['total'] = getMonedaSimbol($ret['moneda_id']).' '.$ret['total'];
			$ret['monto_efectivo'] = getMonedaSimbol($ret['moneda_id']).' '.$ret['monto_efectivo'];
			$ret['contacto_entrega'] = $ret['contacto_entrega'];
			$ret['movil_contacto_entrega'] = $ret['movil_contacto_entrega'];
			$ret['id_forma_pago'] = $ret['id_forma_pago'];
			$ret['id_pago_contraentrega_detalle'] = $ret['id_pago_contraentrega_detalle'];
			$ret['id_cliente_tarjeta'] = $ret['id_cliente_tarjeta'];

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

	public function CrearPedido()
	{
		//DEFINICION DE VARIABLES Y MENSAJES
		$return['estado'] = false;
		$return['mensaje'] = "Problema al crear pedido";
		$productosPedido = array();

		$requestProducto = Input::all();
		$input['cliente_id'] = $requestProducto['cliente_id'];
		if(!$this->validarClienteExistente($input['cliente_id'])) {
			$return['estado'] = false;
			$return['mensaje'] = "No existe el cliente seleccionado";
			return response()->json($return);
		}

		$input['id_direccion'] = $requestProducto['direccion_id'];
		$input['contacto_entrega'] = $requestProducto['contacto'];
		$input['movil_contacto_entrega'] = $requestProducto['celular'];
		$input['subtotal'] = $requestProducto['subtotal'];
		$input['costo_envio'] = $requestProducto['costo_envio'];
		$input['total'] = $requestProducto['subtotal']+$requestProducto['costo_envio'];
		$input['monto_efectivo'] = $requestProducto['monto_efectivo'];
		$input['id_forma_pago'] = $requestProducto['forma_pago_id'];
		$input['id_pago_contraentrega_detalle'] = $requestProducto['pago_contraentrega_detalle_id'];
		//esto para cuando se habilite el ONLINE
		//$input['id_cliente_tarjeta'] = $requestProducto['cliente_tarjeta_id'];

		//METE EN UN ARRAY EL PRODUCTOS_DATA DONDE PONE LOS DETALLES
		$productosDataArray[] = json_decode($requestProducto['productos_data'], true);
		$productosDataArray = $productosDataArray[0]['productos'];

		$productosPedido = $this->validarProductos($productosDataArray);

		//Valida que los productos existan
		if(!($productosPedido)) {
			$return['estado'] = false;
			$return['mensaje'] = "No ha agregado productos válidos al pedido. Al menos uno no es válido.";
			return response()->json($return);
		}

		//Valida que todos los atributos pertenezcan a los productos ingresados
		if(!($this->validarAtributosExistentes($productosDataArray))) {
			$return['estado'] = false;
			$return['mensaje'] = "Todos los atributos deben coincidir con el producto. Al menos uno no coincide.";
			return response()->json($return);
		}

		//CREA PEDIDO CON LO QUE VIENE DEL REQUEST
		$pedido = PedidoRepository::create($input);

		//RECORRE EL PRODUCTOS DATA
		foreach ($productosDataArray as $nkey => $pdata) {
			$productoId = $pdata['producto_id'];
			$productoAtributoIds = $pdata['producto_atributo_id'];
			$cantidad = $pdata['cantidad'];
			$arrAtribExiste = array();

			$inputDetail['producto_id'] = $productoId;
			$inputDetail['cantidad'] = $cantidad;
			$inputDetail['orden_id'] = $pedido->id;

			$matchProducto = ['id' => $productoId];

			//OBTIENE EL PRODUCTO DEPENDIENDO DEL ID
			$producto = Producto::where($matchProducto)->select('*')->get();

			//VALIDA SI NO ENCUENTRA PRODUCTO
			if ($producto->isEmpty()) {
				$productoReturn[$nkey]['id_producto'] = 'ID producto inexistente';
				continue;
			} else {
				$producto = $producto->ToArray();
			}

			foreach ($productoAtributoIds as $atributoIds) {
				$existeAtributo = $this->validarAtributoDeProducto($atributoIds, $productoId);

				if ($existeAtributo) {
					$arrAtribExiste[] = $atributoIds;
				} else {
					$arrAtribExiste[] = '';
				}
			}

			//OBTIENE ARRAY DE ATRIBUTOS Y LOS METE
			$productoAtributoId = json_encode($arrAtribExiste);
			$inputDetail['producto_atributo_id'] = $productoAtributoId;

			//CREO EN TABLA ORDEN_PRODUCTO
			$pedidoDetail = PedidoProductoRepository::create($inputDetail);

			//SI NO VIENE...
			if (!$pedidoDetail) {
				$return['estado'] = false;
				$return['mensaje'] = "Hubo un problema al crear en la tabla Orden Producto";
				exit;
			} else {
				$pedidoDetailArr[] = $pedidoDetail->ToArray();
			}

			//LISTA DE ATRIBUTOS
			$atributoProductoArray = $this->GetAtributoPorProductoPedido($productoId, $pedido->id);

			$idMoneda = $producto[0]['id_moneda'];

			$productoReturn[$nkey]['id_pedido'] = $pedido->id;
			$productoReturn[$nkey]['id_forma_pago'] = $pedido->id_forma_pago;
			if($pedido->id_pago_contraentrega_detalle != null)
				$productoReturn[$nkey]['id_pago_contraentrega_detalle'] = $pedido->id_pago_contraentrega_detalle;
			if($pedido->id_cliente_tarjeta != null)
				$productoReturn[$nkey]['id_cliente_tarjeta'] = $pedido->id_cliente_tarjeta;
			$productoReturn[$nkey]['id_pedido'] = $pedido->id;
			$productoReturn[$nkey]['subtotal'] = getMonedaSimbol($idMoneda).' '.$pedido->subtotal;
			$productoReturn[$nkey]['costo_envio'] = getMonedaSimbol($idMoneda).' '.$pedido->costo_envio;

			$montoTotal = number_format($pedido->subtotal + $pedido->costo_envio, 2);

			$productoReturn[$nkey]['total'] = getMonedaSimbol($idMoneda).' '.$montoTotal;
			$productoReturn[$nkey]['monto_efectivo'] = getMonedaSimbol($idMoneda).' '.$pedido->monto_efectivo;
			$productoReturn[$nkey]['id_producto'] = $producto[0]['id'];
			$productoReturn[$nkey]['producto'] = $producto[0]['producto'];
			$productoReturn[$nkey]['precio'] = getMonedaSimbol($idMoneda).' '.$producto[0]['precio'];
			$productoReturn[$nkey]['imagen_principal'] = getFullURLImage('crear_pedido').json_decode($producto[0]['imagen_principal'],1)[0];
			$productoReturn[$nkey]['atributo_detalle'] = $atributoProductoArray;
		}

		if(!empty($pedido)) {
			$return['estado'] = true;
			$return['mensaje'] = "Pedido creado exitosamente";
			$return['data'] = $productoReturn;
		}

		return response()->json($return);
	}

	/**
	 * Validaciones
	 */
	
	public function validarProductos($productosArr) {

		foreach($productosArr as $nkey => $pdata) {
			$productoId = $pdata['producto_id'];
			$matchProducto = ['id' => $productoId];
			
			//OBTIENE EL PRODUCTO DEPENDIENDO DEL ID
			$producto = Producto::where($matchProducto)->select('id')->first();
			
			//VALIDA SI NO ENCUENTRA PRODUCTO
			if(!$producto) {
				return false;
			}
		}
		
		return true;
		
	}

	public function validarClienteExistente($clienteId) {

		$matchCliente = ['id' => $clienteId];

		//OBTIENE EL Cliente DEPENDIENDO DEL ID
		$cliente = Cliente::where($matchCliente)->select('id')->first();

		if(!$cliente) {
			return false;
		}

		return true;
	}

	public function validarAtributosExistentes($productosDataArray) {

		foreach ($productosDataArray as $nkey => $pdata) {
			$productoId = $pdata['producto_id'];
			$productoAtributoIds = $pdata['producto_atributo_id'];

			foreach ($productoAtributoIds as $atributoIds) {
				$existeAtributo = $this->validarAtributoDeProducto($atributoIds, $productoId);

				if (!$existeAtributo) {
					return false;
				}
			}
		}
		return true;
	}
	
	public function validarAtributoDeProducto($idAtributoOpcion, $productoId) {
		$response = false;
		
		$matchOpcion = ['id'=>$idAtributoOpcion];
		
		$atributoProductoOpcion = AtributoOpcion::where($matchOpcion)->select('atributo_id')->first();
		
		if(!$atributoProductoOpcion) {
			$response = false;
		} else {
			
			$matchProducto = ['atributo_id' => $atributoProductoOpcion->atributo_id, 'producto_id'=>$productoId];

			//OBTIENE EL PRODUCTO DEPENDIENDO DEL ID
			$atributoProducto = AtributoProducto::where($matchProducto)->select('atributo_id')->first();
			
			if($atributoProducto) {
				$response = true;
			}
		}
		
		return $response;
	}

	/**
	 * Utils
	 */
	
	public function GetAtributoPorProducto($productoId) {
		$matchAtributo = ['producto_id'=>$productoId];
		$atributoProducto = AtributoProducto::where($matchAtributo)->get()->toArray();
		
		if(empty($atributoProducto)) {
			$atributoArray = array();
			return $atributoArray;
		}

		foreach($atributoProducto as $nkey=>$aProd) {
			$atributoId = $aProd['atributo_id'];
			$atributosArray[] = $atributoId;
		}
		
		foreach($atributosArray as $nkey=>$atr) {
			$opcionesArr = array();
			$opcionesIdArr = array();
			$atrId = $atr;
			$matchUsuario = ['id'=> $atrId];
			$atributo = Atributo::where($matchUsuario)->first();
			
			//1
			$atributoArray[$nkey]['atributo_label'] = $atributo->atributo;
			
			$atributoOpcion = AtributoOpcion::where(['atributo_id'=>$atrId])->get();
			$atributoOpcion = $atributoOpcion->ToArray();
			
			foreach($atributoOpcion as $atrOp) {
				$opcionesArr[] = $atrOp['valor'];
				$opcionesIdArr[] = $atrOp['id'];
			}
			
			$opciones = json_encode($opcionesArr);
			$opcionesIds = json_encode($opcionesIdArr);
			
			//2
			$atributoArray[$nkey]['atributo_opciones'] = $opciones;
			//3
			$atributoArray[$nkey]['atributo_opciones_id'] = $opcionesIds;
		}
		
		return $atributoArray;
	}
	
	public function GetAtributoPorProductoPedido($productoId,$pedidoId)
	{
		$match = ['producto_id' => $productoId, 'orden_id' => $pedidoId];
		$ordenProducto = OrdenProducto::where($match)->first();
		
		$atributoSeleccionadoArray = json_decode($ordenProducto->producto_atributo_id, 1);

		if(empty($atributoSeleccionadoArray)) {
			$atributoArray = array();
			return $atributoArray;
		}
		
		foreach($atributoSeleccionadoArray as $nkey=>$atrSelecc) {
			$opcionesArr = array();
			$opcionesIdArr = array();
			
			$matchAtributoOpcion = ['id'=>$atrSelecc];
			$atributoOpcion = AtributoOpcion::where($matchAtributoOpcion)->first();
			
			//Valido si trae opcion
			if(!$atributoOpcion) {
				//1
				$atributoArray[$nkey]['error'] = 'Este valor seleccionado del atributo no tiene un atributo asociado';
				continue;
			}
			
			$atributoID = $atributoOpcion->atributo_id;
			
			$validarAtributo = $this->validarAtributoDeProducto($atributoID, $productoId);

			if(!$validarAtributo) {
				$atributoArray[$nkey]['error'] = 'Este valor seleccionado del atributo no tiene un atributo asociado';
				continue;
			}
			
			$matchAtributo = ['id'=>$atributoID];
			$atributoModel = Atributo::where($matchAtributo)->first();
			$atributoLabel = $atributoModel->atributo;
			
			$matchAtributoOpcionAtributo = ['atributo_id'=>$atributoID];
			$atributoOpcionAtributo = AtributoOpcion::where($matchAtributoOpcionAtributo)->get();
			$atributoOpcionAtributo = $atributoOpcionAtributo->ToArray();
			
			foreach($atributoOpcionAtributo as $atrOp) {
				$opcionesArr[] = $atrOp['valor'];
				$opcionesIdArr[] = $atrOp['id'];
			}
			
			$opciones = json_encode($opcionesArr);
			$opcionesIds = json_encode($opcionesIdArr);
			
			//1
			$atributoArray[$nkey]['atributo_label'] = $atributoLabel;
			//2
			$atributoArray[$nkey]['atributo_opciones'] = $opciones;
			//3
			$atributoArray[$nkey]['atributo_opciones_id'] = $opcionesIds;
			//4
			$atributoArray[$nkey]['id_atributo_seleccionado'] = $atrSelecc;

		}
		
		return $atributoArray;
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
			$matchUsuario = ['id_usuario'=> $us['id'],'visibilidad'=>Constants::OPTION_VALID];
			$data = $model::where($matchUsuario)->get()->ToArray();
			$returnData = array_merge($data,$returnData);
		}
		
		return $returnData;
	}

	/**
	 * Usuarios y empresas
	*/

	public function GetUsuarios($idEmpresa) {
		$usuarios = \GrahamCampbell\BootstrapCMS\Models\User::where($idEmpresa)->get()->toArray();
		return $usuarios;
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