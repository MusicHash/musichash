<?php namespace App\Utils;

use Carbon\Carbon;

/**
 * Time object wrapper
 */
class Time
{
    /**
     * Getter for the current date and time on this server.
     * 
     * @return DateTime
     */
    public static function getDateTime()
    {
        return Carbon::now();
    }
}