<?php
$rep = (new \App\Repositories\Requisition\RequisitionRepository());

dd($rep->getCommitment(3, 5, 34)->get());
