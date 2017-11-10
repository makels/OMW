<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 19.06.2017
 * Time: 11:22
 */
Class Model_News extends DB {

    public function getAll() {
        return $this->getRows("SELECT * FROM `news` ORDER BY `date_time` DESC");
    }

    public function addNews($data) {
        return $this->insert(sprintf("INSERT INTO `news` (`title`, `body`, `main_image`, `status`, `date_time`, `up_slider`, `down_slider`) VALUES ('%s', '%s', '%s', %s, '%s', '%s', '%s')",
            $data["title"], $data["body"], $data["image"], $data["status"], $data["date_time"], $data["up_slider"], $data["down_slider"]));
    }

    public function getById($id) {
        return $this->getRow(sprintf("SELECT * FROM `news` WHERE `id` = %s", $id));
    }

    public function update($data) {
        $this->execute(sprintf("UPDATE `news` SET `title` = '%s', `body` = '%s',`main_image` = '%s', `status` = %s, `date_time` = '%s', `up_slider` = '%s', `down_slider` = '%s' WHERE `id` = %s",
            $data["title"], $data["body"], $data["image"], $data["status"], $data["date_time"], $data["up_slider"], $data["down_slider"], $data["id"]));
    }

    public function setStatus($id, $status) {
        $this->execute(sprintf("UPDATE `news` SET `status` = %s WHERE `id` = %s", $status, $id));
    }

    public function delete($id) {
        $this->execute(sprintf("DELETE FROM `news` WHERE `id` = %s", $id));
    }

    public function deleteImage($id) {
        $this->execute("UPDATE `news` SET `main_image` = '' WHERE `id` = " . $id);
    }

    public function deleteUpSlider($id) {
        $this->execute("UPDATE `news` SET `up_slider` = '' WHERE `id` = " . $id);
    }

    public function deleteDownSlide($id, $index) {
        $news = $this->getRow(sprintf("SELECT * FROM `news` WHERE `id` = %s", $id));
        $down_slider = explode(";", $news["down_slider"]);
        unset($down_slider[$index]);
        $down_slider = implode(";", $down_slider);
        $this->execute("UPDATE `news` SET `down_slider` = '" . $down_slider . "' WHERE `id` = " . $id);
    }




}