<?php

Class Module_Current_User extends Module_Base
{
    function render() {
        $smarty = $this->registry->get("smarty");
        $user = $this->registry->get("user");
        $smarty->assign("user", $user);
        $smarty->assign("is_logged", $user->is_logged());
        return $smarty->fetch(SITE_PATH . "/modules/user/tmpl/current_user.tpl");
    }
}