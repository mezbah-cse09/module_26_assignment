<?php 
namespace App\Helper;

use DateTime;

class Helper{
    public static function isValidDate($dateString) {
        $date = DateTime::createFromFormat('Y-m-d', $dateString);
        return $date && $date->format('Y-m-d') === $dateString;
    }

    public static function isLess($dateStr1,$dateStr2) {
        $date1 = DateTime::createFromFormat('Y-m-d', $dateStr1);
        $date2 = DateTime::createFromFormat('Y-m-d', $dateStr2);
        // return $date && $date->format('Y-m-d') === $dateString;

        $datetime1 = new DateTime($dateStr1);
        $datetime2 = new DateTime($dateStr2);
        return $datetime1<$datetime2;
    }




}