<?php

namespace App\Http\Controllers\Api\Facility\System;

use App\Http\Controllers\Api\Facility\Controller;
use App\Http\Controllers\Api\Facility\System\Traits\AuditDatatables;
use App\Repositories\System\AuditRepository;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    use AuditDatatables;
    protected $audits;

    public function __construct()
    {
        $this->audits = (new AuditRepository());
    }

    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke(Request $request)
    {
        return view('system.audit.index');
    }
}
