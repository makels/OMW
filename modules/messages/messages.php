<?php
/**
 * Created by PhpStorm.
 * User: ZERG
 * Date: 26.11.2017
 * Time: 8:01
 */
Class Module_Messages extends Module_Base {

    public function render() {
        $smarty = $this->registry->get("smarty");
        $messages = $this->registry->get("messages");
        $messages_items = $messages->get();
        $smarty->assign("messages_items", $messages_items);
        return $smarty->fetch(SITE_PATH . "/modules/messages/tmpl/messages.tpl");
    }
}