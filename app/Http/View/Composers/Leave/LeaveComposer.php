<?php

namespace App\Http\View\Composers\Leave;

use App\Repositories\Leave\LeaveRepository;
use Illuminate\View\View;

class LeaveComposer
{
    protected $leaves;


    public function __construct()
    {
        $this->leaves = new LeaveRepository();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('leave_access', $this->leaves);
    }
}
