<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 06.07.2017
 * Time: 12:24
 */
Class Module_Products extends Module_Base {

    function render() {
        $smarty = $this->registry->get("smarty");
        $model = DB::loadModel("products/products");
        $products = $model->getAll();
        $smarty->assign("products", $products);
        return $smarty->fetch(SITE_PATH . "/modules/products/tmpl/products.tpl");
    }
}