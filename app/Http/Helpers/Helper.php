<?php
/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 01/11/18
 * Time: 02:10 PM
 */

use GrahamCampbell\BootstrapCMS\Http\Constants as Config;

function getStockName($stockId) {

        $stockName = "";

        switch($stockId) {
            case 1: $stockName=Config::EN_STOCK_LABEL; break;
            case 2: $stockName=Config::AGOTADO_LABEL; break;
            case 3: $stockName=Config::PRONTO_LABEL; break;
        }

        return $stockName;
}