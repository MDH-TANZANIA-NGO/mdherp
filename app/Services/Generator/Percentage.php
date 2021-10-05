<?php


namespace App\Services\Generator;


trait Percentage
{
    public function decimal()
    {
        return [
            '0.00' => '0%',
            '0.25' => '25%',
            '0.50' => '50%',
            '0.75' => '75%',
            '1.00' => '100%',
        ];
    }

}
