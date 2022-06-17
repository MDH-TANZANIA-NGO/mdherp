<?php
/**
 * @developer: hamis
 * @email: hamisjuma1@icloud.com, hamisjuma1@gmail.com, hamisjuma1@yahoo.com
 * @vendor: Lynrant inc
 * Date: 12/15/19
 * Time: 6:50 PM
 */

namespace App\Services\Access\Facade;


use Illuminate\Support\Facades\Facade;

class Access extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'access';
    }
}
