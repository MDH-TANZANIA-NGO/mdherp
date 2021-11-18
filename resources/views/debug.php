<?php

$test = (new \App\Repositories\Project\ActivityRepository());
dd($test->getActivities(access()->id(), access()->user()->region_id, 1));
