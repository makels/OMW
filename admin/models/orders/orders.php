<?php
/**
 * Created by PhpStorm.
 * User: ZERG
 * Date: 29.08.2017
 * Time: 18:00
 */
define('EARTH_RADIUS', 6372795);

function sort_distance($order1, $order2) {
    if($order1["distance"] == 0) return 999999;
    if($order2["distance"] == 0) return 999999;
    return $order1["distance"] - $order2["distance"];
}

Class Model_Orders extends DB {

    public function getAll($filter_status = -1) {
        $where = "";
        $filter = array();
        if($filter_status != -1) {
            $filter[] = "`status` = " . $filter_status;
        }

        if(count($filter) > 0) {
            $where = " WHERE " . implode("AND", $filter);
        }
        $orders = $this->getRows("SELECT * FROM `orders` " . $where . " ORDER BY `id` DESC");
        $result = array();
        foreach ($orders as $order) {
            if($order["user_id"] > 0) $order["client"] = $this->getRow("SELECT * FROM `clients` WHERE `id` = " . $order["user_id"]);
            $result[] = $order;
        }
        return $result;
    }

    public function getById($id) {
        return $this->getRow("SELECT * FROM `orders` WHERE `id` = " . $id);
    }

    public function get($id) {
        return $this->getRow("SELECT * FROM `orders` WHERE `id` = " . $id);
    }

    public function add($data) {
        $sql = sprintf("INSERT INTO `orders` (`user_id`, `washer_id`, `name`, `phone`, `model`, `number`, `address`, `lat`, `lng`, `service`, `photo`, `date_time`, `create_order`, `flyer_number`) VALUES (%s, %s, '%s', '%s', '%s', '%s', '%s', %s, %s, '%s', '%s', '%s', NOW(), '%s')",
            $data["user_id"],
            0,
            $data["name"],
            $data["phone"],
            $data["model"],
            $data["number"],
            $data["address"],
            $data["place"]['lat'],
            $data["place"]['lng'],
            $data["service"],
            $data["photo"],
            $data["date_time"],
            $data["flyer_number"]
        );
        $id = $this->insert($sql);

        return $this->get($id);

    }
    
    public function addFull($data) {
        $sql = sprintf("INSERT INTO `orders` (`user_id`, `washer_id`, `status`, `name`, `phone`, `model`, `number`, `address`, `lat`, `lng`, `service`, `photo`, `date_time`, `create_order`, `flyer_number`) VALUES (%s, %s, %s, '%s', '%s', '%s', '%s', '%s', %s, %s, '%s', '%s', '%s', NOW(), '%s')",
            $data["user_id"],
            $data["washer_id"],
            $data["status"],
            $data["name"],
            $data["phone"],
            $data["model"],
            $data["number"],
            $data["address"],
            $data['lat'],
            $data['lng'],
            $data["service"],
            $data["photo"],
            $data["date_time"],
            $data["flyer_number"]
        );
        $id = $this->insert($sql);
        return $id;
    }

    public function updateFull($data) {
        $sql = sprintf("UPDATE `orders` SET `user_id` = %s, `washer_id` = %s, `status` = %s, `name` = '%s', `phone` = '%s', `model` = %s, `number` = '%s', `address` = '%s', `lat` = %s, `lng` = %s, `service` = %s, `photo` = '%s', `date_time` = '%s', `flyer_number` = '%s' WHERE `id` = %s",
            $data["user_id"],
            $data["washer_id"],
            $data["status"],
            $data["name"],
            $data["phone"],
            $data["model"],
            $data["number"],
            $data["address"],
            $data['lat'],
            $data['lng'],
            $data["service"],
            $data["photo"],
            $data["date_time"],
            $data["flyer_number"],
            $data["id"]
        );
        $this->execute($sql);
    }

    public function setWasher($id, $washer_id) {
        $this->execute("UPDATE `orders` SET `washer_id` = " . $washer_id . " WHERE `id` = " . $id);
    }

    public function setStatus($id, $status) {
        $this->execute("UPDATE `orders` SET `status` = " . $status . " WHERE `id` = " . $id);
    }

    public function delete($id) {
        $this->execute("DELETE FROM `orders` WHERE `id` = " . $id);
    }

    public function getOrders($washer) {
        $current = $this->getRows("SELECT *, 0 as `distance` FROM `orders` WHERE `status` IN (1, 2) AND `washer_id` = " . $washer["id"] . "  ORDER BY `id` DESC");
        $new = $this->getRows("SELECT *, 0 as `distance` FROM `orders` WHERE `status` = 0 ORDER BY `id` DESC");

        $res = array();
        foreach ($current as $order) {
            if($washer["lat"] > 0 && $washer["lng"] > 0 && $order["lat"] > 0 && $order["lng"]) {
                $order["distance"] = $this->getDistance($washer["lat"], $washer["lng"], $order["lat"], $order["lng"]);
                $order["distance"] = round($order["distance"] / 1000, 3);
            }
            $res[] = $order;
        }
        $current = $res;

        $res = array();
        foreach ($new as $order) {
            if($washer["lat"] > 0 && $washer["lng"] > 0 && $order["lat"] > 0 && $order["lng"]) {
                $order["distance"] = $this->getDistance($washer["lat"], $washer["lng"], $order["lat"], $order["lng"]);
                $order["distance"] = round($order["distance"] / 1000, 3);
            }
            $res[] = $order;
        }
        $new = $res;

        usort($current, "sort_distance");
        usort($new, "sort_distance");

        $orders = array_merge($current, $new);
        return $orders;
    }

    public function getOrder($washer, $id) {
        $order = $this->getById($id);
        $order["distance"] = 0;
        if($washer["lat"] > 0 && $washer["lng"] > 0 && $order["lat"] > 0 && $order["lng"]) {
            $order["distance"] = $this->getDistance($washer["lat"], $washer["lng"], $order["lat"], $order["lng"]);
            $order["distance"] = round($order["distance"] / 1000, 3);
        }

        return $order;
    }

    public function getClientOrder($user, $id) {
        $order = $this->getById($id);
        if($order["washer_id"] > 0) {
            $washer = $this->getRow("SELECT * FROM `washers` WHERE `id` = " . $order["washer_id"]);
            $order["washer"] = $washer;
        }
        return $order;
    }

    public function getClientOrders($client_id) {
        $sql = "SELECT * FROM `orders` WHERE `user_id` = " . $client_id . " ORDER BY `date_time` DESC";
        return $this->getRows($sql);
    }

    public function getPrice($service, $type) {
        $row = $this->getRow("SELECT `price` FROM `services` WHERE `type` = " . $type . " AND `service` = " . $service);
        return $row["price"];
    }

    public function deleteImage($id) {
        $this->execute("UPDATE `orders` SET `photo`='' WHERE `id`=" . $id);
    }

    public function updatePosition($id, $lat, $lng) {
        $order = $this->getById($id);
        $order["lat"] = $lat;
        $order["lng"] = $lng;
        $this->updateFull($order);
    }


    private function getDistance ($_lat, $_lng, $_lat1, $_lng1) {

        // перевести координаты в радианы
        $lat1 = $_lat * M_PI / 180;
        $lat2 = $_lat1 * M_PI / 180;
        $long1 = $_lng * M_PI / 180;
        $long2 = $_lng1 * M_PI / 180;

        // косинусы и синусы широт и разницы долгот
        $cl1 = cos($lat1);
        $cl2 = cos($lat2);
        $sl1 = sin($lat1);
        $sl2 = sin($lat2);
        $delta = $long2 - $long1;
        $cdelta = cos($delta);
        $sdelta = sin($delta);

        // вычисления длины большого круга
        $y = sqrt(pow($cl2 * $sdelta, 2) + pow($cl1 * $sl2 - $sl1 * $cl2 * $cdelta, 2));
        $x = $sl1 * $sl2 + $cl1 * $cl2 * $cdelta;

        //
        $ad = atan2($y, $x);
        $dist = $ad * EARTH_RADIUS;

        return $dist;
    }





}