<?php
namespace GrahamCampbell\BootstrapCMS\Http\Libraries;

class ElementLibrary
{
	public static function validacionEmpresa($element, $userCompanyId)
	{
		$arr = array();

		foreach ($element as $el) {
			if ($el->getUserById->usuario_empresa_id != $userCompanyId) {
				continue;
			} else
				$arr[] = $el;
		}

		return $arr;
	}

	public static function validacionEmpresaUser($element, $userCompanyId)
	{
		$arr = array();

		foreach ($element as $el) {
			if ($el->usuario_empresa_id != $userCompanyId) {
				continue;
			} else
				$arr[] = $el;
		}

		return $arr;
	}

	public static function validacionEmpresaPedido($element, $userCompanyId)
	{
		$arr = array();


		foreach ($element as $el) {
			if(!$el->getClientById) {continue;}
			$cliente = $el->getClientById;

			if ($cliente->cliente_empresa_id != $userCompanyId) {
				continue;
			} else
				$arr[] = $el;
		}

		return $arr;
	}

	public static function validacionEmpresaCliente($element, $userCompanyId)
	{
		$arr = array();

		foreach ($element as $el) {
			if ($el->cliente_empresa_id != $userCompanyId) {
				continue;
			} else
				$arr[] = $el;
		}

		return $arr;
	}
}