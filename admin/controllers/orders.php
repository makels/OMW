<?php
/**
 * Created by PhpStorm.
 * User: ZERG
 * Date: 29.08.2017
 * Time: 17:54
 */

Class Controller_Orders Extends Controller_Base
{

    function index()
    {
        $smarty = $this->registry->get("smarty");
        $user = $this->registry->get("user");
        if(!$user->is_admin()) Http::redirect("/admin");
        if ($user->is_admin()) {
            $this->registerModule("menu/menu", "left_side");
            $this->registerModule("orders/orders", "center_side");
            $this->registerModule("modal_map/modal_map", "center_side");
        }

        $smarty->assign('page', 'orders');

        $this->display();
    }

    function edit() {
        $smarty = $this->registry->get("smarty");
        $user = $this->registry->get("user");
        if(!$user->is_admin()) Http::redirect("/admin");
        if($user->is_admin()) {
            $this->registerModule("menu/menu", "left_side");
            $this->registerModule("orders/orders", "center_side");
            $this->registerModule("modal_map/modal_map", "center_side");
        }

        $smarty->assign('page', 'orders');

        $this->display();
    }

    public function delete() {
        $orders = Http::post("order");
        $order_model = DB::loadModel("orders/orders");
        foreach($orders as $id => $val) {
            $order_model->delete($id);
        }

        Http::redirect("/admin/orders");
    }
}