<?php
/**
 * Created by PhpStorm.
 * User: ZERG
 * Date: 29.08.2017
 * Time: 18:00
 */
Class Module_Washers_Reviews extends Module_Base {

    function render() {
        $smarty = $this->registry->get("smarty");
        $model = DB::loadModel("reviews/reviews");

        if(!is_null(Http::post("action")) && Http::post("action") != "") {
            switch (Http::post("action")) {
                case "publish":
                    $this->publish();
                    break;
                case "unpublish":
                    $this->unpublish();
                    break;
                case "delete":
                    $this->delete();
                    break;
            }
        }
        $washers_reviews = $model->getAllWashersReviews();
        $smarty->assign("reviews", $washers_reviews);
        return $smarty->fetch(SITE_PATH . "/modules/washers_reviews/tmpl/washers_reviews.tpl");
    }

    public function publish() {
        $reviews = Http::post("reviews");
        $reviews_model = DB::loadModel("reviews/reviews");
        foreach($reviews as $id => $val) {
            $reviews_model->setWasherActive($id, 1);
        }

        Http::redirect("/admin/washers_reviews");
    }

    public function unpublish() {
        $reviews = Http::post("reviews");
        $reviews_model = DB::loadModel("reviews/reviews");
        foreach($reviews as $id => $val) {
            $reviews_model->setWasherActive($id, 0);
        }

        Http::redirect("/admin/washers_reviews");
    }

    public function delete() {
        $reviews = Http::post("reviews");
        $reviews_model = DB::loadModel("reviews/reviews");
        foreach($reviews as $id => $val) {
            $reviews_model->deleteWasherReview($id);
        }

        Http::redirect("/admin/washers_reviews");
    }
}