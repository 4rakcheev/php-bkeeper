<?php
/**
 * Created by PhpStorm.
 * User: tema
 * Date: 16.09.14
 * Time: 20:22
 */

class DateMonthHelper {

    const DFT_JS='js';
    const DFT_PHP='php';

    public static function getDifferenceMonthCount($fromDate, $toDate)
    {
        $fromDate = new DateTime($fromDate);
        $toDate = new DateTime($toDate);
        $diff = $toDate->diff($fromDate);
        return $diff->m;
    }

    /**
     * Возвращает форматирование даты для унификации
     *
     * @param string $type
     * @return string
     */
    public static function getDateFormat($type=self::DFT_PHP)
    {
        switch ($type) {
            case 'php':
                return 'YYYY-mm-dd';
            case 'js':
                return 'yyyy-mm-dd';
            default:
                return 'dd-mm-YYYY';
        }
    }

} 
