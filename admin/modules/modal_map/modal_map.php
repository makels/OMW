<?php
/**
 * Created by PhpStorm.
 * User: ZERG
 * Date: 21.10.2017
 * Time: 12:08
 */
Class Module_Modal_Map extends Module_Base
{
    function render() {
        $smarty = $this->registry->get("smarty");
        $model = DB::loadModel("orders/orders");
        return $smarty->fetch(SITE_PATH . "/modules/modal_map/tmpl/modal_map.tpl");
    }
}    