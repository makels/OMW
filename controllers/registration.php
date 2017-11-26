<?php
/**
 * Created by PhpStorm.
 * User: ZERG
 * Date: 12.11.2017
 * Time: 15:28
 */

Class Controller_Registration Extends Controller_Base {

    public $breadcrumbs = array();

    function index() {
        $user = $this->registry->get("user");
        $messages = $this->registry->get("messages");
        $smarty = $this->registry->get("smarty");
        $lang = $this->registry->get("lang");
        $lang_prefix = $lang->prefix;

        // Breadcrumbs
        $breadcrumbs = array(
            "home" => array("display" => $lang->translate("Главная"), "url" => $lang->url("/")),
            "registration" => array(
                "display" => $lang->translate("Регистрация"),
                "current" => 1)
        );
        $this->registry->set("breadcrumbs", $breadcrumbs);
        // End breadcrumbs

        $smarty->assign("breadcrumbs", $this->renderModule("breadcrumbs/breadcrumbs"));
        $smarty->assign("lang_prefix", $lang_prefix);
        $smarty->assign("current_user", $this->renderModule("user/current_user"));
        $smarty->assign("select_lang", $this->renderModule("lang/select_lang"));
        $smarty->assign("page", "registration");

        if(isset($_POST['token'])) {
            $s = file_get_contents('http://ulogin.ru/token.php?token=' . $_POST['token'] . '&host=' . $_SERVER['HTTP_HOST']);
            $social_user = json_decode($s, true);
            $model = DB::loadModel("users/user");

            $user_row_login = $model->getByLogin($social_user['network'] . "_" . $social_user['uid']);

            if(is_null($user_row_login)) {
                $model->add(array(
                    "login" => $social_user['network'] . "_" . $social_user['uid'],
                    "first_name" => $social_user['first_name'],
                    "last_name" => $social_user['last_name'],
                    "display_name" => $social_user['first_name'] . " " . $social_user['last_name'],
                    "pass" => "",
                    "email" => "",
                    "is_admin" => 0
                ));
            }

            $user->login = $social_user['network'] . "_" . $social_user['uid'];
            $user->social = $social_user['network'];
            $user->auth();
            if($user->is_logged()) {
                $_SESSION["user"] = $user->toArray();
                Http::redirect("/cabinet");
                exit;
            } else {
                $messages->add($lang->translate("Неверный логин или пароль"));
            }


            Http::redirect("/");
            exit;
        }

        if(Http::post("action") == "registration") {
            $this->registration();
            if(count($messages->items) == 0) {
                $user = new User();
                $user->login = Http::post("email");
                $user->password = Http::post("password");
                $user->auth();
                if(!is_null($user->is_logged())) {
                    $_SESSION["user"] = $user->toArray();
                    Http::redirect("/cabinet");
                    exit;
                } else {
                    $messages->add($lang->translate("Неверный логин или пароль"));
                }
            }
        }
        $this->display("registration");
    }

    function registration() {
        $messages = $this->registry->get("messages");
        $lang = $this->registry->get("lang");
        $smarty = $this->registry->get("smarty");

        $first_name = Http::post("first_name");
        $last_name = Http::post("last_name");
        $email = Http::post("email");
        $password = Http::post("password");

        $smarty->assign("first_name", $first_name);
        $smarty->assign("last_name", $last_name);
        $smarty->assign("email", $email);
        $smarty->assign("password", $password);

        if($first_name == "") $messages->add($lang->translate("Вы не указали имя"));
        if($last_name == "") $messages->add($lang->translate("Вы не указали фамилию"));
        if($email == "") $messages->add($lang->translate("Вы не указали email"));
        if($password == "") $messages->add($lang->translate("Вы не указали пароль"));
        if(!Recaptcha::check()) $messages->add($lang->translate("Вы не прошли проверку CAPTCHA"));

        if(count($messages->items) > 0) return;
        $model = DB::loadModel("users/user");

        $user_row_login = $model->getByLogin($email);
        $user_row_email = $model->getByEmail($email);
        if(!is_null($user_row_login) || !is_null($user_row_email)) {
            $messages->add($lang->translate("Такой email уже зарегистрирован"));
            return;
        }

        $user = $model->add(array(
            "login" => $email,
            "first_name" => $first_name,
            "last_name" => $last_name,
            "display_name" => $first_name . " " . $last_name,
            "pass" => $password,
            "email" => $email,
            "is_admin" => 0
        ));
        $smarty->assign("user", $user);
    }
    
    
}