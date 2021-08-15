<?php

/**
 * Created by PhpStorm.
 * User: MY-PC
 * Date: 7/24/2018
 * Time: 10:27
 */
class Line {

    public function line_notification($line_token, $message, $img = null) {
        if ($img != null) {
            $opts = array(
                'http' => array(
                    'method' => 'POST',
                    'header' => "Content-Type: application/x-www-form-urlencoded\r\n" . 'Authorization: Bearer ' . $line_token,
                    'content' => 'message=' . "\n" . $message . '&imageThumbnail=' . $img . '&imageFullsize=' . $img
                )
            );
        } else {
            $opts = array(
                'http' => array(
                    'method' => 'POST',
                    'header' => "Content-Type: application/x-www-form-urlencoded\r\n" . 'Authorization: Bearer ' . $line_token,
                    'content' => 'message=' . $message
                )
            );
        }
        $context = stream_context_create($opts);
        if (file_get_contents('https://notify-api.line.me/api/notify', false, $context)) {
            return 1;
        } else {
            return 0;
        }
    }

}
