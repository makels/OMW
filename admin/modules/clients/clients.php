<?php
/**
 * Created by PhpStorm.
 * User: ZERG
 * Date: 29.08.2017
 * Time: 18:00
 */
Class Module_Clients extends Module_Base {

    function render() {
        $smarty = $this->registry->get("smarty");
        $model = DB::loadModel("clients/clients");

        if(!is_null(Http::post("action")) && Http::post("action") != "") {
            switch (Http::post("action")) {
                case "create":
                    $smarty = $this->registry->get("smarty");
                    return $smarty->fetch(SITE_PATH . "/modules/clients/tmpl/create_client.tpl");
                case "save":
                    $this->save();
                    break;
                case "delete":
                    $this->delete();
                    break;
            }
        }
        if(Http::get('list') == null && Http::get("id") > 0) {
            $client = $model->getById(Http::get("id"));
            $smarty->assign("client", $client);
            return $smarty->fetch(SITE_PATH . "/modules/clients/tmpl/edit_client.tpl");
        }

        $clients = $model->getAll();
        $smarty->assign("clients", $clients);
        return $smarty->fetch(SITE_PATH . "/modules/clients/tmpl/clients.tpl");
    }

    public function save() {
        $client = Http::post("client");
        if( $client != null && $client["id"] > 0) {
            $this->update();
            return;
        }
        $client = Http::post("client");
        $model = DB::loadModel("clients/clients");
        $id = $model->addNew($client);
        Http::redirect("/admin/clients?list=1");
    }

    public function update() {
        $client = Http::post("client");
        $model = DB::loadModel("clients/clients");
        $model->update($client);
        Http::redirect("/admin/clients?list=1");
    }

    public function delete() {
        $clients = Http::post("clients");
        $clients_model = DB::loadModel("clients/clients");
        foreach($clients as $id => $val) {
            $clients_model->delete($id);
        }

        Http::redirect("/admin/clients");
    }
}