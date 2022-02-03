<?php

namespace App\Http\Controllers\Api\Facility\Web\FinanceReports;

use App\Http\Controllers\Api\Facility\Controller;
use App\Http\Controllers\Api\Facility\Web\FinanceReports\Datatable\paymentBatchDatatable;
use App\Repositories\Finance\FinancialReportsRepository;
use Illuminate\Http\Request;

class FinanceReportsController extends Controller
{
    //
    use paymentBatchDatatable;
    protected $financial_reports;

    public function __construct()
    {
        $this->financial_reports = (new FinancialReportsRepository());
    }
    public function index()
    {
        return view('reports.financialReports.index');
    }
    public function paymentBatches()

    {

        return view('reports.financialReports.Datatables.paymentBatchDatatable')
            ->with('financialReport', $this->financial_reports);
    }

}
