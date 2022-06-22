<?php

namespace App\Http\View\Composers\HumanResource\Advertisement;
//app\Repositories\HumanResource\HireRequisition\HireRequistionRepository.php
use App\Repositories\HumanResource\Advertisement\AdvertisementRepository;
//use App\Repositories\Leave\LeaveRepository;
use Illuminate\View\View;

class AdvertisementComposer
{
    protected $advertisement;


    public function __construct(){
        $this->advertisement = new AdvertisementRepository();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('advertisement', $this->advertisement);
    }
}
