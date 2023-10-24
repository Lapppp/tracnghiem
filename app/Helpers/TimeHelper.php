<?php

namespace App\Helpers;


class TimeHelper
{
    public static function tokenExpire()
    {
        $today = strtotime(date('Y-m-d H:i:s'));
        return $today + (config('jwt.ttl') * 60);
    }

    /**
     * @param $time_ago
     * @return string
     */
    public static function timeAgo($time_ago)
    {
        $time_ago = strtotime($time_ago);
        $cur_time   = time();
        $time_elapsed   = $cur_time - $time_ago;
        $seconds    = $time_elapsed ;
        $minutes    = round($time_elapsed / 60 );
        $hours      = round($time_elapsed / 3600);
        $days       = round($time_elapsed / 86400 );
        $weeks      = round($time_elapsed / 604800);
        $months     = round($time_elapsed / 2600640 );
        $years      = round($time_elapsed / 31207680 );
        // Seconds
        if($seconds <= 60){
            return "mới đăng";
        }
        //Minutes
        else if($minutes <=60){
            if($minutes==1){
                return "1 phút trước";
            }
            else{
                return "$minutes phút trước";
            }
        }
        //Hours
        else if($hours <=24){
            if($hours==1){
                return "1 giờ trước";
            }else{
                return "$hours giờ trước";
            }
        }
        //Days
        else if($days <= 7){
            if($days==1){
                return "hôm qua";
            }else{
                return "$days ngày trước";
            }
        }
        //Weeks
        else if($weeks <= 4.3){
            if($weeks==1){
                return "1 tuần trước";
            }else{
                return "$weeks tuần trước";
            }
        }
        //Months
        else if($months <=12){
            if($months==1){
                return "1 tháng trước";
            }else{
                return "$months tháng trước";
            }
        }
        //Years
        else{
            if($years==1){
                return "1 năm trước";
            }else{
                return "$years năm trước";
            }
        }
    }
}
