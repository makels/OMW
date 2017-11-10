<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 11.01.2016
 * Time: 15:43
 */
Class Controller_Index Extends Controller_Base
{

  function index()
  {
    $smarty = $this->registry->get("smarty");
    $user = $this->registry->get("user");

    if ($user->is_logged() && $user->is_admin()) {
      $this->registerModule("menu/menu", "left_side");
      $this->registerModule("panel/panel", "center_side");
    } else {
      $this->registerModule("login/login", "center_side");
    }

    $smarty->assign('page', 'index');

    $this->display();
  }

  function auth() {
    $user = is_null($this->registry->get("user")) ? new User(): $this->registry->get("user");
    $user->login = !is_null(Http::post("login")) ? Http::post("login") : "";
    $user->password = !is_null(Http::post("password")) ? Http::post("password") : "";
    $user->auth();
    Http::redirect("/admin");
  }

  function logout() {
    $_SESSION = array();
    session_destroy();
    Http::unautorize();
    Http::redirect("/admin");
  }
}