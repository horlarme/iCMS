<?php

namespace ITBLOG;

class OneSignal
{

    public $oneSignal_auth_key = "ODRiMDZlZjgtZTE3OS00ZDk0LTlhYWQtZDY1NTllNzc5MmU3";
//    public $oneSignal_app_id = ;
    public $title = "";
    public $content = "";
    public $address = "";
    public $image = "";

    function sendMessage(){
        $content = array(
            "en" => $this->content
        );
        $headings = array(
            "en" => $this->title
        );

        $fields = array(
            'app_id' => "504da950-0508-41b6-a15c-c60907b67e4c",
            'included_segments' => array('All'),
            'url' => $this->address,
            'contents' => $content,
            'chrome_web_icon' => $this->image
        );

        $fields = json_encode($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
            'Authorization: Basic ODRiMDZlZjgtZTE3OS00ZDk0LTlhYWQtZDY1NTllNzc5MmU3'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

        return true;
    }

}