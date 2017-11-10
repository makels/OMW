<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 06.07.2017
 * Time: 12:29
 */
Class Model_Products extends DB {

    public function getAll() {

        $products = array();
        $items = $this->getRows("SELECT * FROM `products` ORDER BY `model`");
        foreach($items as $item) {
            $options = $this->getRows("SELECT o.*, po.*  FROM `products_options` po
                                       LEFT JOIN `options` o ON po.option_id = id WHERE `product_id` = " . $item["product_id"]);

            $products[] = array(
                "product_id" => $item["product_id"],
                "model" => $item["model"],
                "options" => $options
            );
        }
        return $products;
    }

    public function getById($id) {
        $item = $this->getRow("SELECT * FROM `products` WHERE `product_id` = " . $id);
        $options = $this->getRows("SELECT o.*, po.*  FROM `products_options` po
                                       LEFT JOIN `options` o ON po.option_id = id WHERE `product_id` = " . $item["product_id"]);

        $product = array(
            "product_id" => $item["product_id"],
            "model" => $item["model"],
            "options" => $options
        );
        return $product;
    }

    public function getOption($option_id) {
        return $this->getRow("SELECT * FROM `options` where `id` = " . $option_id);
    }

    public function setProductOptionValue($product_id, $option_id, $value) {
        $option = $this->getOption($option_id);
        $type = $option["type"];
        switch($type) {
            case "bool":
                $this->execute("UPDATE `products_options` SET `bool_value` = " . ($value == 'on' ? 1 : 0) . " WHERE `product_id` = " . $product_id . " AND `option_id` = " . $option_id);
            break;

            case "double":
                $this->execute("UPDATE `products_options` SET `double_value` = " . str_replace(",", ".", $value) . " WHERE `product_id` = " . $product_id . " AND `option_id` = " . $option_id);
                break;

            case "int":
                $this->execute("UPDATE `products_options` SET `int_value` = " . $value . " WHERE `product_id` = " . $product_id . " AND `option_id` = " . $option_id);
                break;

            case "string":
                $this->execute("UPDATE `products_options` SET `string_value` = '" . $value . "' WHERE `product_id` = " . $product_id . " AND `option_id` = " . $option_id);
                break;
        }

    }

}
