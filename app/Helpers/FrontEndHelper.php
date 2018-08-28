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
        $openUntil = null;

        // If the  -to hour slot is null the clinic is not working
        if(!$hours->{$currentDay . '-to'})
            return false;

        // if the clinics have working hours 00:00 on both -to hour slots
        // This means that clinic is working 24h (whole day)
        if($hours->{$currentDay . '-to'} === '00:00' && $hours->{$currentDay . '-to2'} === '00:00')
            return true;

        $openUntil = $hours->{$currentDay . '-to'} > $hours->{$currentDay . '-to2'} ?
                $hours->{$currentDay . '-to'} : $hours->{$currentDay . '-to2'};

        if(
            !$openUntil ||
            strtotime($openUntil . ':00') < strtotime($currentHour)
        )
            return false;

        return true;
    }
}
