<?php
namespace App\Services\Calculator\GetNoDays;


trait GetNoDays
{

    public function getNoDays($from, $to)
    {

        $datetime1 = new \DateTime($from);
        $datetime2 = new  \DateTime($to);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a');
        $days = (int)$days + 1;


        return $days;
    }

}
