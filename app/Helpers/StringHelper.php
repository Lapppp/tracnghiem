<?php

namespace App\Helpers;


class StringHelper
{
    /**
     * @param  string  $prefix
     * @param  int  $length
     * @return string
     */
    public static function generateRandomCode($prefix = 'GS', $length = 6)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = $prefix;
        for ( $i = 0 ; $i < $length ; $i++ ) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * @param  int  $number
     * @param  int  $length
     * @return mixed
     */
    public static function generateProductRandomCode($number = 0, $length = 6)
    {
        return self::getLength($number, $length);
    }

    /**
     * @param $number
     * @param $length
     * @return int|string
     */
    public static function getLength($number, $length)
    {
        $number = !empty($number) ? (int) $number : null;
        if ( !empty($number) ) {
            $newNumber = $number + 1;
            if ( strlen($number) == strlen($length) ) {
                return $newNumber;
            } elseif ( strlen($number) < strlen($length) ) {
                $iLength = $length - $number;
                return str_repeat("0", $iLength).''.$newNumber;
            }
        } else {
            return str_repeat("0", $length - 1).'1';
        }

    }

    /**
     * @param $str
     * @return mixed
     */
    public static function removeStringVn($str)
    {
        $aCode = [
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd' => 'đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D' => 'Đ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        ];

        foreach ( $aCode as $key => $value ) {
            $str = preg_replace("/($value)/i", $key, $str);
        }
        return str_replace(' ', '-', $str);
    }

    public static function removeWhiteSpace($str)
    {
        return preg_replace('/\s+/', '', $str);
    }

    public static function removeHTMLTwoString($str, $str2)
    {
        $strRemove = '';
        if ( !empty($str) && !empty($str2) ) {
            $strRemove = $str.' - '.$str2;
        }

        if ( !empty($str) && empty($str2) ) {
            $strRemove = $str;
        }

        if ( empty($str) && !empty($str2) ) {
            $strRemove = $str2;
        }

        return strip_tags(html_entity_decode($strRemove));
    }

    public static function Windows1252ToUTF8($text)
    {
        return mb_convert_encoding($text, "Windows-1252", "UTF-8");
    }

    public static function cutWord($text, $num = 20)
    {
        $text = preg_replace("/ +/i", " ", $text);
        $a = explode(" ", $text);
        $count = count($a);
        if ( $num > $count ) {
            return $text;
        }
        $l = 0;
        for ( $i = 0 ; $i < $num ; $i++ ) {
            $l += strlen($a[$i]) + 1;
        }
        return substr($text, 0, $l).' ...';
    }

    public static function decodeString($str)
    {
        return html_entity_decode(strip_tags($str));
    }

    public static function cutWordString($str)
    {
        $str = self::decodeString($str);
        return self::cutWord($str);
    }

    public static function getNumberFromString($str)
    {
        return preg_replace('/[^0-9]/', '', $str);
        //preg_replace('/\D/', '', $string);
        //preg_replace('/[^0-9.]/','',$string)
        //preg_match_all('/([\d]+)/', $string, $match);
        //   return $match[0];
    }

    public static function getFileNameFromImage($image)
    {
        $info = pathinfo($image);
        return basename($image, '.'.$info['extension']);
    }

    public static function getExtensionFromImage($image)
    {
        $array = explode('.', $image);
        return end($array);
    }

    public static function generatePassword($length)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars), 0, $length);
    }

    // Hàm này chuyển đổi từ 1 số sang một ký tự
    public static function convertToLetter(int $num): string
    {
        return strtoupper(base_convert($num + 9, 10, 36));
       // return chr($num+65);
    }

    public  static function getAnimation($i = 0) {
        $aAnimation = [
            'animate_25ms',
            'animate_50ms',
            'animate_100ms',
            'animate_150ms',
            'animate_200ms',
            'animate_250ms',
            'animate_300ms',
            'animate_350ms',
            'animate_400ms',
            'animate_450ms',
            'animate_500ms',
        ];

        return isset($aAnimation[$i]) ?? 'animate_300ms';
    }

}
