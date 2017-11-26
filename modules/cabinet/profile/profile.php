<?php
/**
 * Created by PhpStorm.
 * User: ZERG
 * Date: 26.11.2017
 * Time: 9:30
 */
Class Module_Cabinet_Profile extends Module_Base
{
    function render() {
        $smarty = $this->registry->get("smarty");
        $user = $this->registry->get("user");
        $smarty->assign("user", $user);

        if(Http::post("action") == "avatar") {
            $avatar = !is_null(Http::file("avatar")) ? FileManager::uploadAvatar($user->id, Http::file("avatar")) : $user->avatar;
            $user->setAvatar($avatar);
            $user->refresh();
        }

        if(Http::post("action") == "save") {
            $model = DB::loadModel("users/user");
            $data = array(
                "id" => $user->id,
                "name" => $user->login,
                "display_name" => Http::post("first_name") . " " . Http::post("last_name"),
                "first_name" => Http::post("first_name"),
                "last_name" => Http::post("last_name"),
                "avatar" => $user->avatar,
                "email" => Http::post("email"),
                "is_admin" => $user->is_admin ? 1 : 0,
                "password" => ""
            );
            if(!is_null(Http::post("password"))) $data["password"] = Http::post("password");
            $model->update($user->id, $data);
            $user->refresh();
        }
        $smarty->assign("user", $user);
        return $smarty->fetch(SITE_PATH . "/modules/cabinet/profile/tmpl/profile.tpl");
    }
}