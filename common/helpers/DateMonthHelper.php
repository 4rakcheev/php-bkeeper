<?php
/**
 * Created by PhpStorm.
 * User: tema
 * Date: 16.09.14
 * Time: 20:22
 */

class DateMonthHelper {

    public static function getDifferenceMonthCount($fromDate, $toDate)
    {
        $fromDate = new DateTime($fromDate);
        $toDate = new DateTime($toDate);
        $diff = $toDate->diff($fromDate);
        return $diff->m;
    }
} 
