<?php
/**
 * Created by PhpStorm.
 * User: ZERG
 * Date: 29.08.2017
 * Time: 18:00
 */
Class Module_Washers extends Module_Base {

    function render() {
        $smarty = $this->registry->get("smarty");
        $model = DB::loadModel("washers/washers");
        $smarty->assign("GOOGLE_KEY", GOOGLE_KEY);
        if(!is_null(Http::post("action")) && Http::post("action") != "") {
            switch (Http::post("action")) {
                case "create":
                    $smarty = $this->registry->get("smarty");
                    return $smarty->fetch(SITE_PATH . "/modules/washers/tmpl/create_washer.tpl");
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
            $smarty->assign("washer", $client);
            return $smarty->fetch(SITE_PATH . "/modules/washers/tmpl/edit_washer.tpl");
        }

        $washers = $model->getAll();
        $smarty->assign("washers", $washers);
        $smarty->assign("washers_json", json_encode($washers));
        return $smarty->fetch(SITE_PATH . "/modules/washers/tmpl/washers.tpl");
    }

    public function save() {
        $washer = Http::post("washer");
        if( $washer != null && $washer["id"] > 0) {
            $this->update();
            return;
        }
        $washer = Http::post("washer");
        $model = DB::loadModel("washers/washers");
        $id = $model->addNew($washer);
        Http::redirect("/admin/washers?list=1");
    }

    public function update() {
        $washer = Http::post("washer");
        $model = DB::loadModel("washers/washers");
        $model->update($washer);
        Http::redirect("/admin/washers?list=1");
    }

    public function delete() {
        $washers = Http::post("washers");
        $washers_model = DB::loadModel("washers/washers");
        foreach($washers as $id => $val) {
            $washers_model->delete($id);
        }

        Http::redirect("/admin/washers");
    }
}