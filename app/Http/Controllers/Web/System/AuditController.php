<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Http\Controllers\System\Traits\AuditDatatables;
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
