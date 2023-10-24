<?php

namespace App\Helpers;


class UserAgentHelper
{
    /**
     * @url https://stackoverflow.com/questions/6322112/check-if-php-page-is-accessed-from-an-ios-device
     * @return string
     */
    public static function userAgent()
    {
        $iPod = strpos($_SERVER['HTTP_USER_AGENT'], "iPod");
        $iPhone = strpos($_SERVER['HTTP_USER_AGENT'], "iPhone");
        $iPad = strpos($_SERVER['HTTP_USER_AGENT'], "iPad");
        $android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");
        if ( $iPad || $iPhone || $iPod ) {
            return 'iOS';
        } else {
            if ( $android ) {
                return 'Android';
            } else {
                return 'Website';
            }
        }
    }
}
