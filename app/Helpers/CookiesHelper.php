<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cookie;

class CookiesHelper
{

    public static function setCookies($cookiesValue)
    {
        $cookies = Cookie::get('products');
        if ( $cookies ) {
            $json = json_decode($cookies, true);
            array_push($json, $cookiesValue);
            $result = array_unique($json);
            $value = json_encode($result);
            Cookie::queue(cookie('products', $value, config('cookies_config.cookies')));
        } else {
            $value = json_encode([$cookiesValue]);
            Cookie::queue(cookie('products', $value, config('cookies_config.cookies')));
        }
    }

    public static function setCookiesOrder($cookiesValue)
    {
        $cookies = Cookie::get('order_id');
        if ( $cookies ) {
            Cookie::queue(cookie('order_id', $cookiesValue, config('cookies_config.cookies')));
        } else {
            Cookie::queue(cookie('order_id', $cookiesValue, config('cookies_config.cookies')));
        }
    }
}
