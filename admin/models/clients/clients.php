<?php
/**
 * Created by PhpStorm.
 * User: ZERG
 * Date: 16.09.2017
 * Time: 16:11
 */

Class Model_Clients extends DB {

    public function getAll() {
        $clients = $this->getRows("SELECT * FROM `clients` ORDER BY `name`");
        for($i = 0; $i < count($clients); $i++) {
            $current_wash_count = $this->getRow("SELECT count(*) as cnt FROM `orders` WHERE `user_id` = " . $clients[$i]["id"] . " AND `status` = 3 AND `date_time` > date_format(`date_time`, '%Y%m') = date_format(now(), '%Y%m')");
            $wash_count = $this->getRow(sprintf("SELECT count(*) as cnt FROM `orders` WHERE `user_id` = %s AND `status` = 3",
                $clients[$i]["id"]));
            $clients[$i]["current_wash_count"] = $current_wash_count > 0 ? $current_wash_count : 0;
            $clients[$i]["wash_count"] = $wash_count > 0 ? $wash_count : 0;
        }
        return $clients;
    }

    public function getById($id) {
        $client = $this->getRow("SELECT * FROM `clients` WHERE `id` = " . $id);
        $sql = "SELECT count(*) as cnt FROM `orders` WHERE `user_id` = " . $client["id"] . " AND `status` = 3 AND date_format(`date_time`, '%Y%m') = date_format(now(), '%Y%m')";
        $current_wash_count = $this->getRow($sql);
        $wash_count = $this->getRow(sprintf("SELECT count(*) as cnt FROM `orders` WHERE `user_id` = %s AND `status` = 3",
            $client["id"]));
        $client["current_wash_count"] = $current_wash_count["cnt"] > 0 ? $current_wash_count["cnt"] : 0;
        $client["wash_count"] = $wash_count["cnt"] > 0 ? $wash_count["cnt"] : 0;
        return $client;
    }
    
    public function addNew($data) {
        return $this->insert(sprintf("INSERT INTO `clients` (`name`, `phone`, `email`, `pass`, `rest`, `ball`) VALUES ('%s', '%s', '%s', '%s', %s, %s)",
            $data["name"],
            $data["phone"],
            $data["email"],
            md5($data["pass"]),
            $data["rest"],
            $data["ball"]));
    }

    public function update($data) {
        if(isset($data["pass"]) && $data["pass"] != "") {
            $this->execute(sprintf("UPDATE `clients` SET `name`='%s', `phone`='%s', `email`='%s', `pass`='%s', `rest`=%s, `ball`=%s WHERE `id`=%s",
                $data["name"],
                $data["phone"],
                $data["email"],
                md5($data["pass"]),
                $data["rest"],
                $data["ball"],
                $data["id"]));
        } else {
            $this->execute(sprintf("UPDATE `clients` SET `name`='%s', `phone`='%s', `email`='%s', `rest`=%s, `ball`=%s WHERE `id`=%s",
                $data["name"],
                $data["phone"],
                $data["email"],
                $data["rest"],
                $data["ball"],
                $data["id"]));
        }

    }

    public function getByEmail($email) {
        return $this->getRow(sprintf("SELECT * FROM `clients` WHERE email = '%s'", $email));
    }

    public function add($data) {
        return $this->insert(sprintf("INSERT INTO `clients` (`name`, `phone`, `email`, `pass`) VALUES ('%s', '%s', '%s', '%s')", $data["name"], $data["phone"], $data["email"], md5($data["pass"])));
    }

    public function delete($id) {
        $this->execute("DELETE FROM `clients` WHERE `id`=" . $id);
    }

}