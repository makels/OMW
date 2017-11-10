<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 20.06.2017
 * Time: 8:01
 */
Class Model_News extends DB {

    public function getList() {
        return $this->getRows("SELECT * FROM `news` ORDER BY `date_time` ASC LIMIT 0, 3");
    }

    public function getNext($start) {
        return $this->getRows("SELECT * FROM `news` ORDER BY `date_time` LIMIT " . $start . ", 3");
    }

    public function getNews($id) {
        return $this->getRow(sprintf("SELECT * FROM `news` WHERE `id` = %s", $id));
    }

    public function getOthers($id) {
        return $this->getRows("SELECT * FROM `news` WHERE `id` != " . $id . " ORDER BY `date_time` DESC LIMIT 0, 2");
    }



}