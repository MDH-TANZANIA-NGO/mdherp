<?php


namespace App\Http\Controllers\System\Traits;

use Yajra\DataTables\DataTables;

trait AuditDatatables
{
    public function allDatatables()
    {
        $audits = $this->audits->getAll();
        return DataTables::of($audits)
            ->make();
    }
}
