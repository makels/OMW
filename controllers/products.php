<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 17.06.2017
 * Time: 16:29
 */
Class Controller_products Extends Controller_Base {

    function index() {
        $smarty = $this->registry->get("smarty");
        $products_model = DB::loadModel("products");

        $ids = $products_model->getProductsByFilter(array(
            "side" => !is_null(Http::get("side")) ? Http::get("side") : "all",
            "type" => !is_null(Http::get("type")) ? Http::get("type") : "all",
            "size" => !is_null(Http::get("size")) ? Http::get("size") : "all"
        ));

        $cabinet_sizes = $products_model->getCabinetSizes($ids);

        // INDOOR
        $categories_indoor = $products_model->getCategories(0);
        for($i = 0; $i < count($categories_indoor); $i++) {
            unset($image);
            $products = $products_model->getProductsCategory($categories_indoor[$i]["id"]);
            $categories_indoor[$i]["pinches"] = array();
            $categories_indoor[$i]["show"] = 0;
            foreach($products as $product) {
                $is_indoor = $products_model->getOptionValue($product["product_id"], 1);
                $images = $products_model->getOptionValue($product["product_id"], 33);
                if($images != "" && !isset($image)) {
                    $images = explode(", ", $images);
                    if(count($images) > 0) {
                        $image = $images[0];
                    }
                }
                if($is_indoor == 1 && in_array($product["product_id"], $ids)) {
                    $categories_indoor[$i]["show"] = 1;
                    $categories_indoor[$i]["image"] = isset($image) ? $image : "";
                    $categories_indoor[$i]["pinches"][] = array(
                        "product_id" => $product["product_id"],
                        "value" => $products_model->getOptionValue($product["product_id"], 5)
                    );
                }
            }
        }

        // OUTDOOR
        $categories_outdoor = $products_model->getCategories(0);
        for($i = 0; $i < count($categories_indoor); $i++) {
            unset($image);
            $products = $products_model->getProductsCategory($categories_outdoor[$i]["id"]);
            $categories_outdoor[$i]["pinches"] = array();
            $categories_outdoor[$i]["show"] = 0;
            foreach($products as $product) {
                $is_outdoor = $products_model->getOptionValue($product["product_id"], 2);
                $images = $products_model->getOptionValue($product["product_id"], 33);
                if($images != "" && !isset($image)) {
                    $images = explode(", ", $images);
                    if(count($images) > 0) {
                        $image = $images[0];
                    }
                }
                if($is_outdoor == 1 && in_array($product["product_id"], $ids)) {
                    $categories_outdoor[$i]["show"] = 1;
                    $categories_outdoor[$i]["image"] = isset($image) ? $image : "";
                    $categories_outdoor[$i]["pinches"][] = array(
                        "product_id" => $product["product_id"],
                        "value" => $products_model->getOptionValue($product["product_id"], 5)
                    );
                }
            }
        }
        $smarty->assign("categories_indoor", $categories_indoor);
        $smarty->assign("categories_outdoor", $categories_outdoor);
        $smarty->assign("cabinet_sizes", $cabinet_sizes);

        $this->registerModule("product_filter/filter", "center_side");

        $this->display("products");
    }

}