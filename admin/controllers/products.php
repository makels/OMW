<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 06.07.2017
 * Time: 12:23
 */
Class Controller_Products Extends Controller_Base
{

    function index() {
        $smarty = $this->registry->get("smarty");
        $user = $this->registry->get("user");
        if(!$user->is_admin()) Http::redirect("/admin");
        if($user->is_admin()) {
            $this->registerModule("menu/menu", "left_side");
            $this->registerModule("products/products", "center_side");
        }

        $smarty->assign('page', 'products');

        $this->display();
    }

    function edit() {
        $smarty = $this->registry->get("smarty");
        $user = $this->registry->get("user");
        if(!$user->is_admin()) Http::redirect("/admin");
        if($user->is_admin()) {
            $this->registerModule("menu/menu", "left_side");
            $this->registerModule("products/product", "center_side");
        }

        $smarty->assign('page', 'products');

        $this->display();
    }

    function save() {
        $smarty = $this->registry->get("smarty");
        $user = $this->registry->get("user");
        if(!$user->is_admin()) Http::redirect("/admin");
        if($user->is_admin()) {
            $this->registerModule("menu/menu", "left_side");
            $this->registerModule("products/product", "center_side");
        }

        $smarty->assign('page', 'products');

        $this->display();
    }
}