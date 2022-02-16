<?php

namespace App\Http\View\Composers\Listing;

use App\Repositories\Listing\ListingRepository;
use Illuminate\View\View;

class ListingComposer
{
    protected $listings;


    public function __construct(){
        $this->listings = new ListingRepository();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('listing_access', $this->listings);
    }
}
