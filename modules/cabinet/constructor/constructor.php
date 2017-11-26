<?php
/**
 * Created by PhpStorm.
 * User: ZERG
 * Date: 26.11.2017
 * Time: 13:59
 */

Class Module_Cabinet_Constructor extends Module_Base
{
    function render() {
        $smarty = $this->registry->get("smarty");
        $user = $this->registry->get("user");
        $smarty->assign("user", $user);
        return $smarty->fetch(SITE_PATH . "/modules/cabinet/constructor/tmpl/constructor.tpl");
    }
}