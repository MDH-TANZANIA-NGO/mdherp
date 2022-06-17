<?php

namespace App\Http\Controllers\Web\Budget;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Budget\Traits\BudgetDatatables;
use App\Models\Budget\Budget;
use App\Repositories\Budget\BudgetRepository;
use App\Repositories\Budget\FiscalYearRepository;
use App\Repositories\Project\ActivityRepository;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    use BudgetDatatables;

    protected $budgets;
    protected $activities;
    protected $fiscal_years;

    public function __construct()
    {
        $this->budgets = (new BudgetRepository());
        $this->activities = (new ActivityRepository());
        $this->fiscal_years = (new FiscalYearRepository());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('budget.budget.index')
            ->with('activities', $this->activities->getActive()->pluck('code_title','id'))
            ->with('fiscal_years', $this->fiscal_years->getActive()->pluck('title', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->budgets->processStore($request->all());
        alert()->success('Budget Created Successfully','success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Budget $budget)
    {
        return ['budget' => $budget];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Budget $budget)
    {
        $this->budgets->update($request->all(), $budget);
        return redirect()->back()->with('success','Budget Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
