<?php

if (!function_exists('isClinicOpen')) {

    /**
     * description
     *
     * @param object $hours
     * @return boolean
     */
    function isClinicOpen($hours, $currentDay, $currentHour)
    {

        if(!$hours->{$currentDay . '-to'})
            $openUntil = null;
        else
            $openUntil = $hours->{$currentDay . '-to'} > $hours->{$currentDay . '-to2'} ?
                $hours->{$currentDay . '-to'} : $hours->{$currentDay . '-to2'};

        $open = true;

        if(
            !$openUntil ||
            strtotime($openUntil . ':00') < strtotime($currentHour)
        ){
            $open = false;
        }

        return $open;
    }
}
