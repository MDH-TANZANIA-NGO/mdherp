<?php

namespace App\Http\View\Composers\HumanResource\HireRequisition;
//app\Repositories\humanResource\hireRequisition\HireRequistionRepository.php
use App\Repositories\HumanResource\HireRequisition\HireRequisitionRepository;
//use App\Repositories\Leave\LeaveRepository;
use Illuminate\View\View;

class HireRequisitionComposer
{
    protected $listings;


    public function __construct(){
        $this->listings = new HireRequisitionRepository();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('hire_requisition', $this->listings);
    }
}
