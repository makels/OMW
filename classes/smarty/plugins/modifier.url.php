<?php

function smarty_modifier_url($url) {
    global $registry;
    $lang = $registry->get("lang");
    return "/" . $lang->prefix . $url;
}