<?php

namespace App\Http\View\Composers\InductionSchedule;

use App\Repositories\InductionSchedule\InductionScheduleRepository;
use Illuminate\View\View;

class InductionComposer
{
    protected $induction;


    public function __construct()
    {
        $this->induction = new InductionScheduleRepository();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('induction_access', $this->induction);
    }
}
