<?php

namespace App\Http\View\Composers\WfTrack;

use App\Repositories\Workflow\WfTrackRepository;
use Illuminate\View\View;

class WfTrackComposer
{
    protected $wf_track;


    public function __construct()
    {
        $this->wf_track = new WfTrackRepository();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('workflow_navigation', $this->wf_track);
    }
}
