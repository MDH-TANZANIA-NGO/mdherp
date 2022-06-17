<?php

/**
 * This file is where all MDH configurations are done
 * @developer Hamis Hamis
 * @email hamisjuma1@gmail.com
 * @title Software Developer
 */

return [

    /**
     * Superuser authentication particulars
     */
    'email' => env('U_EMAIL', 'admin@mdh.or.tz'),
    'password' => env('U_PASSWORD', 'Mdh123'),

    /**
     * Project
     */
    'project' => [
        'with_region' => 13,
    ],

];
