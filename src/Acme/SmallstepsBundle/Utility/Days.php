<?php

namespace App\Utility;

/**
 * Description of Days
 *
 * @author RM
 */
class Days {
    
    

    public function daysInWeek($weekNum) {
        $result = array();
        $datetime = new \DateTime();
        $datetime->setISODate((int) $datetime->format('Y'), $weekNum, 1);
        $interval = new \DateInterval('P1D');
        $week = new \DatePeriod($datetime, $interval, 4);

        foreach ($week as $day) {
            $result[] = $day->format('d-m-Y');
        }

        return $result;
    }

    public function currentWeek() {
        $today = date('d-m-y H:i:s');
        //get this week's thursday date and set time to noon
        $thus = date("d-m-y H:i:s", strtotime(' this week thursday noon'));
        //get the week number for the following week
        $week = date('W', strtotime("next week"));

        // var_dump($week);
        //check if the time of booking is greater than thursday noon if so set week to 2 weeks ahead
        if ($today >= $thus) {
            $week = date('W', date(strtotime("next Thursday", strtotime("next Thursday"))));
        }
        return $week;
    }

    public function weekStart() {
        $today = date('d-m-y H:i:s');
        //get this week's thursday date and set time to noon
        $thus1 = date("d-m-y H:i:s", strtotime(' this week thursday noon'));
        //get the week number for the following week
        $weekStart = date('d-m-y', strtotime("next week Saturday"));
        //check if the time of booking is greater than thursday noon if so set week to 2 weeks ahead
        if ($today >= $thus1) {
            $weekStart = date('d-m-y', date(strtotime("next Monday", strtotime("next Monday"))));
        }

        return $weekStart;
    }

    function getDateForSpecificDayBetweenDates($startDate, $endDate, $weekdayNumber) {
        $startDate = strtotime($startDate);
        $endDate = strtotime($endDate);

        $dateArr = array();

        do {
            if (date("w", $startDate) != $weekdayNumber) {
                $startDate += (24 * 3600); // add 1 day
            }
        } while (date("w", $startDate) != $weekdayNumber);


        while ($startDate <= $endDate) {
            $dateArr[] = date('Y-m-d', $startDate);
            $startDate += (7 * 24 * 3600); // add 7 days
        }

        return($dateArr);
    }

}
