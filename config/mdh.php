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

    // Performace Review
    'performance_review' => [
        'goals_agreement' => 1,
        'goals_evaluation' => 2,
    ],

    'recruitment_portal_url' => env('RECRUITMENT_PORT_URL','')

];
