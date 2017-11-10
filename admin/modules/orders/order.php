<?php
/**
 * Created by PhpStorm.
 * User: ZERG
 * Date: 14.09.2017
 * Time: 18:51
 */
Class Module_Order extends Module_Base {

    function render() {

        if(isset($_POST["order"])) {
            $this->save();
            exit;
        }

        if(!isset($_GET["id"])) {
            Http::redirect("/admin/orders");
            exit;
        }

        $id = $_GET["id"];
        $smarty = $this->registry->get("smarty");
        $model = DB::loadModel("orders/orders");
        $order = $model->getById($id);
        $smarty->assign("order", $order);
        return $smarty->fetch(SITE_PATH . "/modules/orders/tmpl/order.tpl");
    }

    function save() {
        Http::redirect("/admin/orders");
    }

}