<?php
/**
 * Created by PhpStorm.
 * User: ZERG
 * Date: 26.11.2017
 * Time: 7:40
 */
Class Controller_Cabinet extends Controller_Base {


    function index() {
        $user = $this->registry->get("user");
        $lang = $this->registry->get("lang");
        if(!$user->is_auth()) {
            $messages = $this->registry->get("messages");
            $messages->add($lang->translate("Войдите или зарегистрируйтесь"));
            Http::redirect($lang->url("/login"));
            exit;
        }
        $smarty = $this->registry->get("smarty");




    }

}
