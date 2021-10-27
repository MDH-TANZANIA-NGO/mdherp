<?php


namespace App\Services\Phone;


class PhoneFormatter
{
    public $phone;

    /**
     * PhoneNumberFormat constructor.
     * @param $phone
     */
    public function __construct($phone)
    {
        $this->format($phone);
    }

    /**
     * @param $phone
     * @return bool
     */
    private function format($phone)
    {
        $number = phone($phone, $country = ['TZ'], $format = 'E164');
        $this->phone = substr($number, 1);
        return true;
    }
}
