<?php

use GrahamCampbell\BootstrapCMS\Http\Constants as Config;
use GrahamCampbell\BootstrapCMS\Models\Product as ProductModel;


function formatPagination($links) {

	$links = str_replace("<li><a href=", "<li class=\"page-item\"><a class=\"page-link\" href=", $links);
	$links = str_replace("<li class=\"disabled\"><span>", "<li class=\"disabled page-item\"><span class=\"page-link\">", $links);
	$links = str_replace("<li class=\"active\"><span>", "<li class=\"active page-item\"><span class=\"page-link\">", $links);

	return $links;

}

//@todo: remove from helpers

function getProductMainImageById($id) {

	$products = ProductModel::where('id', $id)->first();

	return $products['filename_main'];
}

function getProductsNameByIds($id) {

	$products = ProductModel::where('id', $id)->first();

	return $products['producto'];
}

function getJsonValue($value) {
	return json_decode($value)[0];
}

function getCantidadElementos($arr) {
    return count($arr);
}

function formatNumber($id) {
    return str_pad($id, Config::NUMBER_FORMAT_ZEROS, '0', STR_PAD_LEFT);
}

function getColorByStatus($idEstado) {

    $color = 'btn-secondary';

    switch($idEstado) {
        case 1: $color='btn-danger';break;
        case 2: $color='btn-warning';break;
        case 3: $color='btn-success';break;
    }

    return $color;
}

function formatStringToDateTime($string) {
	$time = strtotime($string);
	$newformat = date('Y-m-d H:i:s',$time);

	return $newformat;
}

function formatTimeText($date) {
    setlocale(LC_TIME, 'es_CO.UTF-8');
    $formattedDate = strtotime($date);
    $hour = date('H:i:s', $formattedDate);
    return strftime("%d de %B de %G a las $hour", $formattedDate);
}
function getStockName($stockId) {

        $stockName = "";

        switch($stockId) {
            case 1: $stockName=Config::EN_STOCK_LABEL; break;
            case 2: $stockName=Config::AGOTADO_LABEL; break;
            case 3: $stockName=Config::PRONTO_LABEL; break;
        }

        return $stockName;
}
function formatCurrentTime($time) {
    if(isset($time)) {
        return $time =
            strtotime(date('Y-m-d H:i',strtotime('+5 hours',strtotime($time))));
    }
}
function timeSince($original) {

    $original = formatCurrentTime($original);

    $ta = array(
        array(31536000, "Año", "Años"),
        array(2592000, "Mes", "Meses"),
        array(604800, "Semana", "Semanas"),
        array(86400, "Día", "Días"),
        array(3600, "Hora", "Horas"),
        array(60, "Minuto", "Minutos"),
        array(1, "Segundo", "Segundos")
    );
    $since = time() - $original;
    $res = "";
    $lastkey = 0;
    for( $i=0; $i<count($ta); $i++ ){
        $cnt = floor($since / $ta[$i][0]);
        if ($cnt != 0) {
            $since = $since - ($ta[$i][0] * $cnt);
            if($res == ""){
                $res .= ($cnt == 1) ? "1 {$ta[$i][1]}" : "{$cnt} {$ta[$i][2]}";
                $lastkey = $i;
            } else if ($ta[0] >= 60 && ($i - $lastkey) == 1 ){
                $res .= ($cnt == 1) ? " y 1 {$ta[$i][1]}" : " y {$cnt} {$ta[$i][2]}";
                break;
            } else {
                break;
            }
        }
    }
    return $res;
}