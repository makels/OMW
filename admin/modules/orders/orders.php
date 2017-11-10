<?php
/**
 * Created by PhpStorm.
 * User: ZERG
 * Date: 29.08.2017
 * Time: 18:00
 */
Class Module_Orders extends Module_Base {

    function render() {
        $smarty = $this->registry->get("smarty");
        $model = DB::loadModel("orders/orders");

        $clients_model = DB::loadModel("clients/clients");
        $washers_model = DB::loadModel("washers/washers");

        $clients = $clients_model->getAll();
        $washers = $washers_model->getAll();

        $smarty->assign("clients", $clients);
        $smarty->assign("washers", $washers);
        $smarty->assign("GOOGLE_KEY", GOOGLE_KEY);

        if(is_null(Http::get("filter_status")) && !is_null(Http::post("action")) && Http::post("action") != "") {
            switch (Http::post("action")) {
                case "create":
                    $smarty = $this->registry->get("smarty");
                    return $smarty->fetch(SITE_PATH . "/modules/orders/tmpl/create_order.tpl");
                case "save":
                    $this->save();
                    break;
                case "delete":
                    $this->delete();
                    break;
                case "delete_image":
                    $this->deleteImage();
                    break;
            }
        }


        $filter_status = Http::get("filter_status");
        if($filter_status == null) $filter_status = -1;
        $smarty->assign("filter_status", $filter_status);

        if(Http::get("id") > 0) {
            $order = $model->getById(Http::get("id"));
            $smarty->assign("order", $order);
            return $smarty->fetch(SITE_PATH . "/modules/orders/tmpl/edit_order.tpl");
        }

        $orders = $model->getAll($filter_status);
        $smarty->assign("orders", $orders);
        $smarty->assign("orders_json", json_encode($orders));
        return $smarty->fetch(SITE_PATH . "/modules/orders/tmpl/orders.tpl");
    }

    public function save() {
        $order = Http::post("order");
        if( $order != null && $order["id"] > 0) {
            $this->update();
            return;
        }
        $order = Http::post("order");
        if(!is_null(Http::file("photo"))) {
            $order["photo"] = FileManager::uploadImage(Http::file("photo"));
        }
        $order["address"] = str_replace("'", "\'", $order["address"]);
        $model = DB::loadModel("orders/orders");
        $model->addFull($order);
        Http::redirect("/admin/orders?filter_status=-1");
    }

    public function update() {
        $order = Http::post("order");
        $order["photo"] = Http::post("exist_photo");
        if(!is_null(Http::file("photo"))) {
            $order["photo"] = FileManager::uploadImage(Http::file("photo"));
        }
        $model = DB::loadModel("orders/orders");
        $model->updateFull($order);
        Http::redirect("/admin/orders?filter_status=-1");
    }

    public function delete() {
        $orders = Http::post("order");
        $order_model = DB::loadModel("orders/orders");
        foreach($orders as $id => $val) {
            $order_model->delete($id);
        }

        Http::redirect("/admin/orders");
    }

    public function deleteImage() {
        $order = Http::post("order");
        $model = DB::loadModel("orders/orders");
        $model->deleteImage($order["id"]);
        Http::redirect("/admin/orders?filter_status=-1");
    }


}