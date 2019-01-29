<?php
namespace GrahamCampbell\BootstrapCMS\Http\Libraries;

class ElementLibrary
{
	public static function validacionEmpresa($element, $userCompanyId)
	{
		$arr = array();

		foreach ($element as $el) {
			if ($el->getUserById->user_company_id != $userCompanyId) {
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
			if ($el->user_company_id != $userCompanyId) {
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
			$cliente = $el->getClientById;
			if ($cliente->getUserById->user_company_id != $userCompanyId) {
				continue;
			} else
				$arr[] = $el;
		}

		return $arr;
	}
}