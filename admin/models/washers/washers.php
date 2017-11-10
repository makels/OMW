<?php
/**
 * Created by PhpStorm.
 * User: ZERG
 * Date: 16.09.2017
 * Time: 16:30
 */
Class Model_Washers extends DB {

    public function getAll() {
        return $this->getRows("SELECT * FROM `washers` ORDER BY `name`");
    }

    public function getByEmail($email) {
        return $this->getRow(sprintf("SELECT * FROM `washers` WHERE email = '%s'", $email));
    }

    public function getById($id) {
        return $this->getRow("SELECT * FROM `washers` WHERE `id` = " . $id);
    }

    public function addNew($data) {
        $sql = sprintf("INSERT INTO `washers` (`name`, `phone`, `email`, `pass`, `address`, `lat`, `lng`, `transport`) VALUES ('%s', '%s', '%s', '%s', '%s', %s, %s, %s)",
            $data["name"],
            $data["phone"],
            $data["email"],
            md5($data["pass"]),
            $data["address"],
            $data["lat"],
            $data["lng"],
            isset($data["transport"]) ? 1 : 0);
        return $this->insert($sql);
    }

    public function update($data) {
        if(isset($data["pass"]) && $data["pass"] != "") {
            $this->execute(sprintf("UPDATE `washers` SET `name`='%s', `phone`='%s', `email`='%s', `pass`='%s', `address`='%s', `lat`=%s, `lng`=%s, `transport`=%s WHERE `id`=%s",
                $data["name"],
                $data["phone"],
                $data["email"],
                md5($data["pass"]),
                $data["address"],
                $data["lat"],
                $data["lng"],
                $data["transport"] == "on" ? 1 : 0,
                $data["id"]));
        } else {
            $this->execute(sprintf("UPDATE `washers` SET `name`='%s', `phone`='%s', `email`='%s', `address`='%s', `lat`=%s, `lng`=%s, `transport`=%s WHERE `id`=%s",
                $data["name"],
                $data["phone"],
                $data["email"],
                $data["address"],
                $data["lat"],
                $data["lng"],
                $data["transport"] == "on" ? 1 : 0,
                $data["id"]));
        }

    }

    public function add($data) {
        return $this->insert(sprintf("INSERT INTO `washers` (`name`, `phone`, `email`, `pass`, `address`, `lat`, `lng`, `transport`) VALUES ('%s', '%s', '%s', '%s', '%s', %s, %s, %s)",
            $data["name"], $data["phone"], $data["email"], md5($data["pass"]), $data["address"], $data["lat"], $data["lng"], $data["transport"]));
    }

    public function delete($id) {
        $this->execute("DELETE FROM `washers` WHERE `id`=" . $id);
    }

    public function updatePosition($id, $lat, $lng) {
        $washer = $this->getById($id);
        $washer["lat"] = $lat;
        $washer["lng"] = $lng;
        $this->update($washer);
    }

}