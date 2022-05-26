<?php

namespace App\Http\View\Composers\HumanResource\HireRequisition;

use App\Repositories\HumanResource\HireRequisition\HireRequisitionRepository;
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
        $view->with('hire_requistion', $this->listings);
    }
}
