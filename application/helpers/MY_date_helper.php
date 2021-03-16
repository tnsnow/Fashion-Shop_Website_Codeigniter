<?php


function get_date($time, $full_time = true)
{
    $fomat = '%d-%m-%Y';
    if($full_time)
    {
        $fomat = $fomat.'-%H:%i:%s';
    }
    $date = mdate($fomat , $time);
     return $date;
}