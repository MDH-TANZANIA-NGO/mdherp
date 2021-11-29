<?php

namespace App\Http\View\Composers\Requisition;

use App\Repositories\Requisition\RequisitionRepository;
use Illuminate\View\View;

class RequisitionComposer
{
    protected $requisitions;


    public function __construct()
    {
        $this->requisitions = new RequisitionRepository();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('requisition_access', $this->requisitions);
    }
}
