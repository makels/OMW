<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 18.06.2017
 * Time: 18:07
 */
Class Controller_product extends Controller_Base {

    function index() {
        $smarty = $this->registry->get("smarty");
        if(Http::get("id") > 0) {
            $model = DB::loadModel("products");
            $product = $model->getProductById(Http::get("id"));
            $smarty->assign("product", $product);

        } else {
            Http::redirect("/products");
            exit;
        }
        $this->display("product");
    }

}