<?php

namespace App\Helpers\Utils;
class Telegram
{
    public function send_telegram($text_msg){
        $is_telegram_enabled = config('app.is_telegram_enabled');
        if ($is_telegram_enabled) {
            $chat_id = intval(config('app.telegram_chat_id'));
            $token = config('app.telegram_token');
            $text = 'Имя - ' . $text_msg->name . PHP_EOL .
                'Дата и время - ' . $text_msg->start_time . PHP_EOL .
                'Телефон - ' . $text_msg->phone . PHP_EOL .
                'Услуга - ' . $text_msg->name_service;
            // following ones are optional, so could be set as null
            $disable_web_page_preview = null;
            $reply_to_message_id = null;
            $reply_markup = null;
            $data = array(
                'chat_id' => urlencode($chat_id),
                'text' => $text,
                'disable_web_page_preview' => urlencode($disable_web_page_preview),
                'reply_to_message_id' => urlencode($reply_to_message_id),
                'reply_markup' => urlencode($reply_markup)
            );
            $url = "https://api.telegram.org/bot" . $token . "/sendMessage";
            //  open connection
            $ch = curl_init();
            //  set the url
            curl_setopt($ch, CURLOPT_URL, $url);
            //  number of POST vars
            curl_setopt($ch, CURLOPT_POST, count($data));
            //  POST data
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            //  To display result of curl
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //  execute post
            $result = curl_exec($ch);
            //  close connection
            curl_close($ch);
        }
    }
}
