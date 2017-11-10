<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 18.06.2017
 * Time: 14:31
 */
Class Module_Filter extends Module_Base {

    function render() {
        $smarty = $this->registry->get("smarty");
        return $smarty->fetch(SITE_PATH . "modules/product_filter/tmpl/filter.tpl");
    }

    public function setFilter() {
        echo json_encode(array("result" => "OK"));
    }


}