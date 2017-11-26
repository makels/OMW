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
        $ext = end(explode(".", $upload_file));
        if(!in_array(array("jpg", "png", "bmp"), $ext)) return null;
        if(move_uploaded_file($file['tmp_name'], $upload_file)) {
            return basename($file['name']);
        } else {
            return null;
        }
    }

    public static function uploadImage($file) {
        $upload_file = UPLOAD_IMAGE_DIR . basename($file['name']);
        $ext = end(explode(".", $upload_file));
        if(!in_array(array("jpg", "png", "bmp"), $ext)) return null;
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
            $ext = end(explode(".", $upload_file));
            if(!in_array(array("jpg", "png", "bmp"), $ext)) continue;
            move_uploaded_file($files['tmp_name'][$i], $upload_file);
            $res[] = basename($files['name'][$i]);
        }
        return $res;
    }

    public static function uploadAvatar($user_id, $file) {
        $upload_file = basename($file['name']);
        $p = explode(".", $upload_file);
        $ext = end($p);
        if(!in_array($ext, array("jpg", "png", "bmp"))) return null;
        $upload_file = Storage::get_path("images") . uniqid("avatar_") . "." . $ext;
        if(move_uploaded_file($file['tmp_name'], $upload_file)) {
            return basename($upload_file);
        } else {
            return null;
        }
    }


}