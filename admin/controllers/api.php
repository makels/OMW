<?php
/**
 * Created by PhpStorm.
 * User: ZERG
 * Date: 29.08.2017
 * Time: 16:34
 */

Class Controller_api Extends Controller_Base {
    
    function index() {
        echo json_encode(array("res" => 0));
    }

    public function login() {
        $email = Http::post("email");
        $pass = Http::post("pass");
        $type = Http::post("type");
        if($type == 0) {
            $model = DB::loadModel("clients/clients");
            $user = $model->getByEmail($email);
            if($user == null) { echo json_encode(array("res" => 1)); exit; }
            if($user["pass"] != md5($pass)) { echo json_encode(array("res" => 1)); exit; }
            echo json_encode(array("res" => 0, "user" => $user));
            exit;
        } else {
            $model = DB::loadModel("washers/washers");
            $washer = $model->getByEmail($email);
            if($washer == null) { echo json_encode(array("res" => 1)); exit; }
            if($washer["pass"] != md5($pass)) { echo json_encode(array("res" => 1)); exit; }
            echo json_encode(array("res" => 0, "washer" => $washer));
            exit;
        }
    }
    
    public function register() {
        $name = Http::post("name");
        $phone = Http::post("phone");
        $email = Http::post("email");
        $pass = Http::post("pass");

        $model = DB::loadModel("clients/clients");
        $client = $model->getByEmail($email);
        if($client != null) {
            echo json_encode(array("res" => 1));
            exit;
        }
        $model->add(array(
            "name" => $name,
            "phone" => $phone,
            "email" => $email,
            "pass" => $pass
        ));

        $user = $model->getByEmail($email);

        $smarty = $this->registry->get("smarty");
        $smarty->assign("name", $name);
        $body = $smarty->fetch(SITE_PATH . "/mails/client_register.tpl");
        Mail::send(array(
            "to" => $email,
            "subject" => "Регистрация в системе bulag.tk",
            "message" => $body
        ));

        echo json_encode(array("res" => 0, "user" => $user));
    }

    public function register_washer() {

        $name = Http::post("name");
        $phone = Http::post("phone");
        $email = Http::post("email");
        $pass = Http::post("pass");
        $lat = Http::post("lat") != 0 ? Http::post("lat") : 37.9600766;
        $lng = Http::post("lng") != 0 ? Http::post("lng") : 58.3260629;
        $address = Http::post("address");
        //$transport = Http::post("transport");
        $transport = 1;

        $model = DB::loadModel("washers/washers");
        $washer = $model->getByEmail($email);
        if($washer != null) {
            echo json_encode(array("res" => 1));
            exit;
        }
        $id = $model->add(array(
            "name" => $name,
            "phone" => $phone,
            "email" => $email,
            "pass" => $pass,
            "address" => $address,
            "lat" => $lat,
            "lng" => $lng,
            "transport" => $transport
        ));

        $washer = $model->getByEmail($email);

        $smarty = $this->registry->get("smarty");
        $smarty->assign("name", $name);
        $body = $smarty->fetch(SITE_PATH . "/mails/washer_register.tpl");
        Mail::send(array(
            "to" => $email,
            "subject" => "Регистрация в системе bulag.tk",
            "message" => $body
        ));

        echo json_encode(array("res" => 0, "washer" => $washer));
    }


    public function refresh_rest() {
        $email = Http::post("email");
        $pass = Http::post("pass");
        $model = DB::loadModel("clients/clients");
        $user = $model->getByEmail($email);
        if($user != null && $user["pass"] == md5($pass)) {
            echo json_encode(array("res" => 0, "rest" => $user["rest"], "ball" => $user["ball"]));
        } else {
            echo json_encode(array("res" => 1));
        }
        exit;
    }
    
    public function new_order() {
        $filename = "";
        if(Http::post("photo") != null && Http::post("photo") != "") {
            $filename = uniqid("order_") . ".jpg";
            $file = UPLOAD_DIR . "/" . $filename;
            $ifp = fopen( $file, 'wb' );
            $base64_string = Http::post("photo");
            $data = $base64_string;
            fwrite( $ifp, base64_decode( $data ) );
            fclose( $ifp );
        }

        if (Http::post("phone") != null) {

            $model = DB::loadModel("orders/orders");
            $place = Http::post("place") != null ? Http::post("place") : array(
                "lat" => 37.9600766,
                "lng" => 58.3260629
            );

            $order_data = array(
                "user_id" => Http::post("user_id"),
                "name" => Http::post("name"),
                "phone" => Http::post("phone"),
                "model" => Http::post("model"),
                "number" => Http::post("number"),
                "flyer_number" => Http::post("flyer_number"),
                "place" => $place,
                "address" => Http::post("address"),
                "service" => Http::post("service"),
                "photo" => $filename,
                "date_time" => Http::post("date_time")
            );
            $order = $model->add($order_data);

            $smarty = $this->registry->get("smarty");
            $smarty->assign("order", $order);
            $body = $smarty->fetch(SITE_PATH . "/mails/order.tpl");
            Mail::send(array(
                "to" => 'turkmeninfo@yandex.ru,dulag@307075.ru',
                "subject" => "Новый заказ в системе bulag.tk",
                "message" => $body
            ));

            echo json_encode(array("res" => 0, "order" => $order));
            exit;
        } else {
            echo json_encode(array("res" => 1));
            exit;
        }

    }

    public function get_orders() {
        $washer = Http::post("washer");
        if($washer != null) {
            $model = DB::loadModel("orders/orders");
            $orders = $model->getOrders($washer);
            echo json_encode(array("res" => 0, "orders" => $orders));
            exit;
        } else {
            echo json_encode(array("res" => 1));
            exit;
        }
    }

    public function get_order() {
        $id = Http::post("id");
        $washer = Http::post("washer");
        if($id == null || $washer == null) {
            echo json_encode(array("res" => 1));
            exit;
        }
        $model = DB::loadModel("orders/orders");
        $order = $model->getOrder($washer, $id);
        if($order == null) {
            echo json_encode(array("res" => 1));
            exit;
        }

        echo json_encode(array("res" => 0, "order" => $order));
        exit;
    }

    public function accept_order() {
        $id = Http::post("id");
        $washer = Http::post("washer");
        if($id == null || $washer == null) {
            echo json_encode(array("res" => 1));
            exit;
        }
        $model = DB::loadModel("orders/orders");
        $model->setWasher($id, $washer["id"]);
        $model->setStatus($id, 1);
        $order = $model->getById($id);
        if($order == null) {
            echo json_encode(array("res" => 1));
            exit;
        }

        echo json_encode(array("res" => 0, "order" => $order));
        exit;
    }

    public function unset_order() {
        $id = Http::post("id");
        $washer = Http::post("washer");
        if($id == null || $washer == null) {
            echo json_encode(array("res" => 1));
            exit;
        }
        $model = DB::loadModel("orders/orders");
        $model->setWasher($id, 0);
        $model->setStatus($id, 0);
        $order = $model->getById($id);
        if($order == null) {
            echo json_encode(array("res" => 1));
            exit;
        }

        echo json_encode(array("res" => 0, "order" => $order));
        exit;
    }

    public function start_order() {
        $id = Http::post("id");
        $washer = Http::post("washer");
        if($id == null || $washer == null) {
            echo json_encode(array("res" => 1));
            exit;
        }
        $model = DB::loadModel("orders/orders");
        $model->setStatus($id, 2);
        $order = $model->getById($id);
        if($order == null) {
            echo json_encode(array("res" => 1));
            exit;
        }

        echo json_encode(array("res" => 0, "order" => $order));
        exit;
    }

    public function end_order() {
        $id = Http::post("id");
        $washer = Http::post("washer");
        if($id == null || $washer == null) {
            echo json_encode(array("res" => 1));
            exit;
        }
        $model = DB::loadModel("orders/orders");
        $model->setStatus($id, 3);
        $order = $model->getById($id);
        if($order == null) {
            echo json_encode(array("res" => 1));
            exit;
        }

        echo json_encode(array("res" => 0, "order" => $order));
        exit;
    }

    public function price() {
        $service = Http::post("service");
        $type = Http::post("type");
        $model = DB::loadModel("orders/orders");
        $price = $model->getPrice($service, $type);
        echo json_encode(array("res" => 0, "price" => $price));
    }

    public function get_client_reviews() {
        $client_id = Http::post("user_id");
        $model = DB::loadModel("reviews/reviews");
        if(!is_null($client_id)) {
            $reviews = $model->getReviews($client_id);
            echo json_encode(array("res" => 0, "reviews" => $reviews));
            exit;
        } else {
            echo json_encode(array("res" => 1));
            exit;
        }
    }

    public function add_client_review() {
        $client_id = Http::post('client_id');
        $washer_id = Http::post('washer_id');
        $rating = Http::post('rating');
        $review = Http::post('review');
        $model = DB::loadModel('reviews/reviews');
        $model->addReview(array(
            "client_id" => $client_id,
            "washer_id" => $washer_id,
            "rating" => $rating,
            "review" => $review
        ));
        echo json_encode(array("res" => 0));
    }

    public function add_washer_review() {
        $client_id = Http::post('client_id');
        $washer_id = Http::post('washer_id');
        $rating = Http::post('rating');
        $review = Http::post('review');
        $model = DB::loadModel('reviews/reviews');
        $model->addWasherReview(array(
            "client_id" => $client_id,
            "washer_id" => $washer_id,
            "rating" => $rating,
            "review" => $review
        ));
        echo json_encode(array("res" => 0));
    }

    public function get_client_orders() {
        $client_id = Http::post('client_id');
        if($client_id != null && $client_id > 0) {
            $model = DB::loadModel("orders/orders");
            $orders = $model->getClientOrders($client_id);
            echo json_encode(array("res" => 0, "orders" => $orders));
            exit;
        } else {
            echo json_encode(array("res" => 1));
            exit;
        }
    }

    public function get_client_order() {
        $id = Http::post("id");
        $user = Http::post("user");
        if($id == null || $user == null) {
            echo json_encode(array("res" => 1));
            exit;
        }
        $model = DB::loadModel("orders/orders");
        $order = $model->getClientOrder($user, $id);
        if($order == null) {
            echo json_encode(array("res" => 1));
            exit;
        }

        echo json_encode(array("res" => 0, "order" => $order));
        exit;
    }

    public function get_washer_reviews() {
        $washer_id = Http::post("washer_id");
        $model = DB::loadModel("reviews/reviews");
        if(!is_null($washer_id)) {
            $reviews = $model->getWasherReviews($washer_id);
            echo json_encode(array("res" => 0, "reviews" => $reviews));
            exit;
        } else {
            echo json_encode(array("res" => 1));
            exit;
        }
    }

    public function update_position() {
        $order_id = Http::post("order_id");
        $lat = Http::post("lat");
        $lng = Http::post("lng");
        $model = DB::loadModel("orders/orders");
        $model->updatePosition($order_id, $lat, $lng);
        echo json_encode(array("res" => 0));
    }

    public function update_washer_position() {
        $washer_id = Http::post("washer_id");
        $lat = Http::post("lat");
        $lng = Http::post("lng");
        $model = DB::loadModel("washers/washers");
        $model->updatePosition($washer_id, $lat, $lng);
        echo json_encode(array("res" => 0));
    }
    
}