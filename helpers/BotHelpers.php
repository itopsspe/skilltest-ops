<?php

namespace app\helpers;

use Yii;

class BotHelpers
{
    public static function sendMessage($token, $chat_id, $text, $parse_mode, $reply_to_message_id, $reply_markup)
	{
        $params = [
            'chat_id' => $chat_id,
            'text' => $text,
            'parse_mode' => $parse_mode,
            'reply_to_message_id' => $reply_to_message_id ? $reply_to_message_id : null,
            'reply_markup' => $reply_markup ? json_encode($reply_markup) : null
        ];

        $response = file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($params));

        return $response;
    }

    public static function sendPhoto($token, $chat_id, $photo, $caption, $reply_markup)
	{
        $params = [
            'chat_id' => $chat_id,
            'photo' => $photo,
            'caption' => $caption,
            'parse_mode' => 'html',
            'reply_markup' => $reply_markup ? json_encode($reply_markup) : null
        ];

        $response = file_get_contents("https://api.telegram.org/bot$token/sendPhoto?" . http_build_query($params));

        return $response;
    }

    public static function deleteMessage($token, $chat_id, $message_id)
    {
        $params = [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
        ];

        $response = file_get_contents("https://api.telegram.org/bot$token/deleteMessage?" . http_build_query($params));

        return $response;
    }
}
  
?>