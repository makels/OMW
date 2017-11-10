<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 18.06.2017
 * Time: 7:15
 */
Class Model_products extends DB {

    public function getCategories($parent = 0) {
        return $this->getRows(sprintf("SELECT * FROM `categories` WHERE `parent_id` = %s", $parent));
    }

    public function getProductsCategory($category_id) {
        return $this->getRows(sprintf("SELECT * FROM `products` p
                                       LEFT JOIN `products_category` c ON p.product_id = c.product_id
                                       WHERE c.category_id = %s", $category_id));
    }

    public function getOptionValue($product_id, $option_id) {
        $option = $this->getRow(sprintf("SELECT * FROM `options` WHERE `id` = %s", $option_id));
        $value_row = $this->getRow(sprintf("SELECT * FROM `products_options` WHERE `product_id` = %s AND `option_id` = %s",$product_id, $option_id));
        return $value_row[$option["type"] . "_value"];
    }

    public function getCabinetSizes($ids) {
        return $this->getRows(sprintf("SELECT DISTINCT string_value FROM `products_options` WHERE `option_id` = 6 AND `product_id` IN (%s) ORDER BY string_value", implode(",", $ids)));
    }

    public function getProductById($id) {
        $data = $this->getRows("SELECT * FROM `products` p
                                LEFT JOIN `products_options` po ON p.product_id = po.product_id
                                LEFT JOIN `options` o ON po.option_id = o.id
                                WHERE p.product_id = " . $id);
        $product = array();
        if(count($data) > 0) {
            $product["model"] = $data[0]["model"];
            $product["product_id"] = $data[0]["product_id"];
            $product["options"] = array();
            $product["images"] = array();
            foreach($data as $row) {
                if($row["option_id"] > 4 && $row["show"] == 1) {
                    $product["options"][] = array(
                        "option_id" => $row["option_id"],
                        "name" => $row["name"],
                        "value" => $row[$row["type"] . "_value"]
                    );
                }
                if($row["option_id"] > 4 && $row["show"] == 2) {
                    $product["options1"][] = array(
                        "option_id" => $row["option_id"],
                        "name" => $row["name"],
                        "value" => $row[$row["type"] . "_value"]
                    );
                }
                if($row["option_id"] == 33 || $row["option_id"] == 34 || $row["option_id"] == 35 || $row["option_id"] == 36) {
                    $images = explode(", ", $row[$row["type"] . "_value"]);
                    foreach($images as $image) {
                        $product["images"][] = $image;
                    }
                }
            }

            return $product;
        } else return null;
    }

    public function getProductsByFilter($filter) {

        // INDOOR / OUTDOOR
        $ids = array();
        $sql = "SELECT DISTINCT product_id FROM `products_options`";
        if($filter["side"] == "indoor")
            $sql = "SELECT DISTINCT product_id FROM `products_options`
                    WHERE option_id = 1 AND bool_value = 1";
        elseif($filter["side"] == "outdoor")
            $sql = "SELECT DISTINCT product_id FROM `products_options`
                    WHERE option_id = 2 AND bool_value = 1";

        $products = $this->getRows($sql);

        foreach($products as $product) {
            $ids[] = $product["product_id"];
        }

        // INSTALATION / RENT
        if($filter["type"] != "all") {
            $type = $filter["type"] == "installation" ? 1 : 0;
            $products = $this->getRows(sprintf("SELECT DISTINCT product_id FROM `products_options`
                                            WHERE product_id IN (%s) AND option_id = 3 AND bool_value = %s",
                implode(",", $ids), $type));
            $ids = array();
            foreach($products as $product) {
                $ids[] = $product["product_id"];
            }
        }

        // CABINET SIZE
        if($filter["size"] != "all") {
            $products = $this->getRows(sprintf("SELECT DISTINCT product_id FROM `products_options`
                                            WHERE product_id IN (%s) AND option_id = 6 AND string_value = '%s'",
                implode(",", $ids), $filter["size"]));
            $ids = array();
            foreach($products as $product) {
                $ids[] = $product["product_id"];
            }
        }

        return $ids;
    }

}