<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 19.06.2017
 * Time: 10:52
 */
Class Module_News extends Module_Base {

    function render() {
        $smarty = $this->registry->get("smarty");
        $news_model = DB::loadModel("news/news");
        if(!is_null(Http::post("action")) && Http::post("action") != "") {
            switch(Http::post("action")) {
                case "create":
                    $smarty = $this->registry->get("smarty");
                    return $smarty->fetch(SITE_PATH . "/modules/news/tmpl/create_news.tpl");
                case "save":
                    $this->save();
                    break;
                case "publish":
                    $this->publish();
                    break;
                case "unpublish":
                    $this->unpublish();
                    break;
                case "delete":
                    $this->delete();
                    break;
                case "delete_image":
                    $this->deleteImage();
                    break;
                case "delete_up_slider":
                    $this->deleteUpSlider();
                    break;

            }

        }

        foreach($_POST as $key => $value) {
            if(strpos($value, "delete_down_slider_") !== "false" && isset($_POST["id"])) {
                $index = str_replace("delete_down_slider_", "", $value);
                $news_model->deleteDownSlide($_POST["id"], $index);
            }
        }

        if(Http::get("id") > 0) {
            $news = $news_model->getById(Http::get("id"));
            $down_slider = explode(";", $news["down_slider"]);
            $smarty->assign("news", $news);
            $smarty->assign("down_slider", $down_slider);
            return $smarty->fetch(SITE_PATH . "/modules/news/tmpl/edit_news.tpl");
        }

        $model = DB::loadModel("news/news");
        $news = $model->getAll();
        $smarty->assign("news", $news);
        return $smarty->fetch(SITE_PATH . "/modules/news/tmpl/news.tpl");
    }

    public function publish() {
        $ids = Http::post("item");
        $model = DB::loadModel("news/news");
        foreach($ids as $id => $state) {
            $model->setStatus($id, 1);
        }
    }

    public function unpublish() {
        $ids = Http::post("item");
        $model = DB::loadModel("news/news");
        foreach($ids as $id => $state) {
            $model->setStatus($id, 0);
        }
    }

    public function delete() {
        $ids = Http::post("item");
        $model = DB::loadModel("news/news");
        foreach($ids as $id => $state) {
            if($state == "on") {
                $model->delete($id);
            }
        }
    }

    public function save() {
        if(Http::post("id") > 0) {
            $this->update();
            return;
        }
        $model = DB::loadModel("news/news");
        $title = Http::post("title");
        $body = Http::post("body");
        $status = Http::post("publish") == "on" ? 1 : 0;
        $date_time = DB::getSQLDate(Http::post("date_time"));

        if(!is_null(Http::file("image"))) {
            $image = FileManager::uploadImage(Http::file("image"));
            if(!file_exists(UPLOAD_IMAGE_DIR . $image)) {
                // TODO:: Implement handle error
                return;
            }
        }

        if(!is_null(Http::file("up_slider"))) {
            $up_slider = FileManager::uploadImage(Http::file("up_slider"));
        }

        if(!is_null(Http::file("down_slider"))) {
            $down_slider = FileManager::uploadImages(Http::file("down_slider"));
            $down_slider = implode(";", $down_slider);
        }

        $model->addNews(array(
            "title" => $title,
            "body" => $body,
            "status" => $status,
            "image" => $image,
            "date_time" =>$date_time,
            "up_slider" => $up_slider,
            "down_slider" => $down_slider
        ));
        Http::redirect("/admin");
        exit;
    }

    public function update() {
        $model = DB::loadModel("news/news");
        $id = Http::post("id");
        $title = Http::post("title");
        $body = Http::post("body");
        $status = Http::post("publish") == "on" ? 1 : 0;
        $date_time = DB::getSQLDate(Http::post("date_time"));

        $image = "";

        if(Http::post("exist_image") != "") {
            $image = Http::post("exist_image");
        } else {
            $image = "";
            if(!is_null(Http::file("image"))) {
                $image = FileManager::uploadImage(Http::file("image"));
                if(!file_exists(UPLOAD_IMAGE_DIR . $image)) {
                    // TODO:: Implement handle error
                    return;
                }
            }
        }

        if(Http::post("exist_up_slider") != "") {
            $up_slider = Http::post("exist_up_slider");
        } else {
            $up_slider = "";
            if(!is_null(Http::file("up_slider"))) {
                $up_slider = FileManager::uploadImage(Http::file("up_slider"));
                if(!file_exists(UPLOAD_IMAGE_DIR . $up_slider)) {
                    // TODO:: Implement handle error
                    return;
                }
            }
        }

        $down_slider = array();
        if(is_array(Http::post("exist_down_slider"))) {
            $down_slider = Http::post("exist_down_slider");
        }

        if(!is_null(Http::file("down_slider"))) {
            $down_slider[] = FileManager::uploadImage(Http::file("down_slider"));
        }

        $model->update(array(
            "id" => $id,
            "title" => $title,
            "body" => $body,
            "status" => $status,
            "image" => $image,
            "date_time" =>$date_time,
            "up_slider" => $up_slider,
            "down_slider" => implode(";", $down_slider)
        ));
    }

    public function deleteImage(){
        $model = DB::loadModel("news/news");
        $model->deleteImage(Http::post("id"));
    }

    public function deleteUpSlider(){
        $model = DB::loadModel("news/news");
        $model->deleteUpSlider(Http::post("id"));
    }

}