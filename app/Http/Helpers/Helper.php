<?php

use GrahamCampbell\BootstrapCMS\Http\Constants as Config;

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