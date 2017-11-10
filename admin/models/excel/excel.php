<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 17.06.2017
 * Time: 11:03
 */

class Model_Excel extends DB {

    public function add_product($product) {
        $id = $this->insert("INSERT INTO `products` (`model`) VALUES ('" . $product["model"] . "')");
        foreach($product["options"] as $option) {
            if($option["type"] == "string") $this->insert(sprintf("INSERT INTO `products_options` (`product_id`, `option_id`, `string_value`) VALUES (%s, %s, '%s')", $id, $option["id"], $option["value"]));
            else $this->insert(sprintf("INSERT INTO `products_options` (`product_id`, `option_id`, `%s_value`) VALUES (%s, %s, '%s')", $option["type"], $id, $option["id"], $option["value"]));
        }

        $category = $this->getRow(sprintf("SELECT `id` FROM `categories` WHERE `name` = '%s'", $product["category"]));
        $this->insert(sprintf("INSERT INTO `products_category` (`category_id`, `product_id`) VALUES (%s, %s)", $category["id"], $id));

        return $id;
    }

    public function clear_products() {
        $this->execute("DELETE FROM `products`");
        $this->execute("DELETE FROM `products_options`");
        $this->execute("DELETE FROM `products_category`");
        $this->execute("ALTER TABLE `products` AUTO_INCREMENT = 1");
        $this->execute("ALTER TABLE `products_options` AUTO_INCREMENT = 1");
        $this->execute("ALTER TABLE `products_category` AUTO_INCREMENT = 1");
    }

    public function get_options() {
        return $this->getRows("SELECT * FROM `options`");
    }

}