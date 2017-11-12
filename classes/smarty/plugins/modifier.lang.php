<?php
/**
 * Created by PhpStorm.
 * User: ZERG
 * Date: 12.11.2017
 * Time: 11:16
 */

function smarty_modifier_lang($str) {
    global $registry;
    $lang = $registry->get("lang");
    return $lang->translate($str);
}