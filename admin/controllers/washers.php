<?php
/**
 * Created by PhpStorm.
 * User: ZERG
 * Date: 23.09.2017
 * Time: 18:36
 */
Class Controller_Washers Extends Controller_Base
{

    function index()
    {
        $smarty = $this->registry->get("smarty");
        $user = $this->registry->get("user");

        if ($user->is_admin()) {
            $this->registerModule("menu/menu", "left_side");
            $this->registerModule("washers/washers", "center_side");
            $this->registerModule("modal_map/modal_map", "center_side");
        }

        $smarty->assign('page', 'washers');

        $this->display();
    }

    function edit() {
        $smarty = $this->registry->get("smarty");
        $user = $this->registry->get("user");

        if($user->is_admin()) {
            $this->registerModule("menu/menu", "left_side");
            $this->registerModule("washers/washers", "center_side");
            $this->registerModule("modal_map/modal_map", "center_side");
        }

        $smarty->assign('page', 'washers');

        $this->display();
    }

    
}