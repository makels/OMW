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

        // Breadcrumbs
        $breadcrumbs = array(
            "home" => array("display" => $lang->translate("Главная"), "url" => $lang->url("/")),
            "cabinet" => array("display" => $lang->translate("Кабинет"), "url" => $lang->url("/cabinet"))
        );

        $smarty = $this->registry->get("smarty");
        $page = isset($_GET["page"]) && $_GET["page"] != "" ? $_GET["page"] : "profile";

        switch ($page) {
            // Profile
            case "profile":
                $this->registerModule("cabinet/profile/profile", "center_side");
                $smarty->assign('page', 'profile');
                $breadcrumbs["profile"] = array("display" => $lang->translate("Профиль"), "current" => 1);
                break;

            // Constructor
            case "constructor":
                $this->registerModule("cabinet/constructor/constructor", "center_side");
                $smarty->assign('page', 'constructor');
                $breadcrumbs["constructor"] = array("display" => $lang->translate("Конструктор"), "current" => 1);
                break;
        }

        $this->registry->set("breadcrumbs", $breadcrumbs);

        $smarty->assign("current_user", $this->renderModule("user/current_user"));
        $smarty->assign("select_lang", $this->renderModule("lang/select_lang"));
        $smarty->assign("breadcrumbs", $this->renderModule("breadcrumbs/breadcrumbs"));
        $this->registerModule("menu/menu", "left_side");
        $this->display("cabinet");

    }

}
