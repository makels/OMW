<?php
/**
 * Created by PhpStorm.
 * User: Zerg
 * Date: 18.06.2017
 * Time: 7:03
 */
Class Controller_news Extends Controller_Base {

    function index() {
        $smarty = $this->registry->get("smarty");
        $model = DB::loadModel("news");
        if(isset($_GET["id"]) && $_GET["id"] > 0) {
            $news = $model->getNews(Http::get("id"));
            $down_slider = explode(";", $news["down_slider"]);
            $others = $model->getOthers(Http::get("id"));

            $smarty->assign("others", $others);
            $smarty->assign("news", $news);
            $smarty->assign("down_slider", $down_slider);

            $this->display("news");
            return;
        }

        if(isset($_GET["from"])) {
            $news = $model->getNext($_GET["from"]);
            $smarty->assign("news", $news);
            echo $smarty->fetch(SITE_PATH . "views/news_next.tpl");
            exit;
        }

        $news = $model->getList();
        $smarty->assign("news", $news);
        $this->display("news_list");
    }

}