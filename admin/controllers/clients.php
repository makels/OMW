<?php
/**
 * Created by PhpStorm.
 * User: ZERG
 * Date: 23.09.2017
 * Time: 18:35
 */
Class Controller_Clients Extends Controller_Base
{

    function index()
    {
        $smarty = $this->registry->get("smarty");
        $user = $this->registry->get("user");

        if ($user->is_admin()) {
            $this->registerModule("menu/menu", "left_side");
            $this->registerModule("clients/clients", "center_side");
        }

        $smarty->assign('page', 'clients');

        $this->display();
    }

    function edit() {
        $smarty = $this->registry->get("smarty");
        $user = $this->registry->get("user");

        if($user->is_admin()) {
            $this->registerModule("menu/menu", "left_side");
            $this->registerModule("clients/clients", "center_side");
        }

        $smarty->assign('page', 'clients');

        $this->display();
    }

    
}