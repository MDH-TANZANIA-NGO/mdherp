<?php
$rep = (new \App\Repositories\Access\UserRepository());

dd($rep->getAllNotSubmittedTimesheet(4, 2021));
