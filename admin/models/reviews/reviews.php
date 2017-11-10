<?php
/**
 * Created by PhpStorm.
 * User: ZERG
 * Date: 22.09.2017
 * Time: 17:52
 */
class Model_Reviews extends DB {

    public function getAllReviews() {
        return $this->getRows("SELECT a.id, b.name as client, c.name as washer, a.rating, a.review, a.date, a.active 
                FROM `clients_reviews` a, `clients` b, `washers` c 
                WHERE a.client_id = b.id AND a.washer_id = c.id
                ORDER BY `date` DESC");
    }

    public function getAllWashersReviews() {
        return $this->getRows("SELECT a.id, b.name as client, c.name as washer, a.rating, a.review, a.date, a.active 
                FROM `washers_reviews` a, `clients` b, `washers` c 
                WHERE a.client_id = b.id AND a.washer_id = c.id
                ORDER BY `date` DESC");
    }

    public function getReviews($client_id) {
        return $this->getRows("SELECT b.name as client, c.name as washer, a.rating, a.review, a.date 
                FROM `clients_reviews` a, `clients` b, `washers` c 
                WHERE a.client_id = " . $client_id . " AND a.client_id = b.id AND a.washer_id = c.id AND a.active = 1
                ORDER BY `date` DESC");
    }

    public function getWasherReviews($washer_id) {
        return $this->getRows("SELECT b.name as client, c.name as washer, a.rating, a.review, a.date 
                FROM `washers_reviews` a, `clients` b, `washers` c 
                WHERE a.washer_id = " . $washer_id . " AND a.client_id = b.id AND a.washer_id = c.id AND a.active = 1
                ORDER BY `date` DESC");
    }

    public function addReview($data) {
        $sql = sprintf("INSERT INTO `clients_reviews` (`client_id`, `washer_id`, `rating`, `review`, `date`, `active`) VALUES (%s, %s, %s, '%s', NOW(), 0)",
            $data["client_id"], $data["washer_id"], $data["rating"], $data["review"]);
        return $this->insert($sql);
    }

    public function addWasherReview($data) {
        $sql = sprintf("INSERT INTO `washers_reviews` (`client_id`, `washer_id`, `rating`, `review`, `date`, `active`) VALUES (%s, %s, %s, '%s', NOW(), 0)",
            $data["client_id"], $data["washer_id"], $data["rating"], $data["review"]);
        return $this->insert($sql);
    }

    public function setActive($id, $active) {
        $this->execute("UPDATE `clients_reviews` SET `active` = " . $active . " WHERE `id` = " . $id);
    }

    public function setWasherActive($id, $active) {
        $this->execute("UPDATE `washers_reviews` SET `active` = " . $active . " WHERE `id` = " . $id);
    }

    public function deleteClientReview($id) {
        $this->execute("DELETE FROM `clients_reviews` WHERE `id` = " . $id);
    }

    public function deleteWasherReview($id) {
        $this->execute("DELETE FROM `washers_reviews` WHERE `id` = " . $id);
    }

}