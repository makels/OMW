<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 07.07.2017
 * Time: 10:18
 */
Class Module_Product extends Module_Base {

    function render() {

        if(isset($_POST["product"])) {
            $this->save();
            exit;
        }

        if(!isset($_GET["id"])) {
            Http::redirect("/admin/products");
            exit;
        }

        $id = $_GET["id"];
        $smarty = $this->registry->get("smarty");
        $model = DB::loadModel("products/products");
        $product = $model->getById($id);
        $smarty->assign("product", $product);
        return $smarty->fetch(SITE_PATH . "/modules/products/tmpl/product.tpl");
    }

    function save() {
        $model = DB::loadModel("products/products");
        $id = $_POST["product"]["id"];
        foreach($_POST["option"] as $option_id => $value) {
            $model->setProductOptionValue($id, $option_id, $value);
        }
        Http::redirect("/admin/products");
    }

}