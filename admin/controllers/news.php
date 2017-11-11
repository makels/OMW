<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 19.06.2017
 * Time: 10:46
 */
Class Controller_News Extends Controller_Base
{

    function index() {
        $smarty = $this->registry->get("smarty");
        $user = $this->registry->get("user");
        if(!$user->is_admin()) Http::redirect("/admin");
        if($user->is_admin()) {
            $this->registerModule("menu/menu", "left_side");
            $this->registerModule("news/news", "center_side");
        }

        $smarty->assign('page', 'news');

        $this->display();
    }
}