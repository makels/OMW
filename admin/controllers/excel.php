<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 16.06.2017
 * Time: 14:10
 */
Class Controller_Excel Extends Controller_Base
{

    function index() {
        $smarty = $this->registry->get("smarty");
        $user = $this->registry->get("user");
        if(!$user->is_admin()) Http::redirect("/admin");
        if($user->is_admin()) {
            $this->registerModule("menu/menu", "left_side");
            $this->registerModule("excel/excel", "center_side");
        }

        $smarty->assign('page', 'excel');

        $this->display();
    }
}