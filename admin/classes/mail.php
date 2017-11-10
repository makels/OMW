<?php
/**
 * Created by PhpStorm.
 * User: ZERG
 * Date: 23.09.2017
 * Time: 21:10
 */
class Mail {

    public static function send($mail) {
        $to      = $mail["to"];
        $subject = $mail['subject'] ;
        $message = $mail['message'] ;
        $header = "From: noreply@bulag.tk\r\n";
        $header.= "MIME-Version: 1.0\r\n";
        $header.= "Content-Type: text/html; charset=utf-8\r\n";
        $header.= "X-Priority: 1\r\n";
        mail($to, $subject, $message, $header);
    }





}