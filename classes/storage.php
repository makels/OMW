<?php
/**
 * Created by PhpStorm.
 * User: ZERG
 * Date: 26.11.2017
 * Time: 13:03
 */

Class Storage {

    public static function get_path($type) {
        global $user;
        $folder = STORAGE . $user->id ."/" . $type . "/";
        if(!is_dir($folder)) mkdir($folder, 0777, true);
        return $folder;
    }



}