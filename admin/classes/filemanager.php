<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 17.06.2017
 * Time: 7:50
 */
class FileManager {

    public static function upload($file) {
        $upload_file = UPLOAD_DIR . basename($file['name']);
        if(move_uploaded_file($file['tmp_name'], $upload_file)) {
            return basename($file['name']);
        } else {
            return null;
        }
    }

    public static function uploadImage($file) {
        $upload_file = UPLOAD_IMAGE_DIR . basename($file['name']);
        if(move_uploaded_file($file['tmp_name'], $upload_file)) {
            return basename($file['name']);
        } else {
            return null;
        }
    }

    public static function uploadImages($files) {
        $res = array();
        for($i = 0; $i < count($files["name"]); $i++) {
            $upload_file = UPLOAD_IMAGE_DIR . basename($files['name'][$i]);
            move_uploaded_file($files['tmp_name'][$i], $upload_file);
            $res[] = basename($files['name'][$i]);
        }
        return $res;
    }


}