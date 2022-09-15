<?php
if ( ! defined( 'ABSPATH' ) ) exit;

abstract class RFT_Validate
{

     public static function bot_token( $botToken ){
         if ( iconv_strlen($botToken) > 43 && iconv_strlen($botToken) < 48 ) {
             return true;
         } else {
             return false;
         }
     }


     public static function chat_id( $chatId ){
         if ( is_numeric($chatId)
             && 7 < iconv_strlen(strval($chatId))
             && 16 > iconv_strlen(strval($chatId))
         ){
             return true;
         }
        
         if (str_starts_with(strval($chatId), '@')) {
             return true;
         }

         return false;
     }


    public static function message_text( $botMsgTxt ){
        //to do
    }


}