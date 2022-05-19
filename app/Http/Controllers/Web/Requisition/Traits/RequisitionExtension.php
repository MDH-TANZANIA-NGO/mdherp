<?php

namespace App\Controller\Http\Web\Requisition\Traits;

trait RequisitionExtension
{
    /**
     * Remove the specified resource from storage.
     *
     * @param $requisition_type_id
     * @param $project_id
     * @param $activity_id
     * @param $region_id
     * @param $fiscal_year
     * @return \Illuminate\Http\JsonResponse
     */
    public function getResultsJson(Request $request)
    {
        $requisition_type_id = $request->only('requisition_type_id');
        $project_id = $request->only('project_id');
        $activity_id = $request->only('activity_id');
        $region_id = $request->only('region_id');
        $fiscal_year = $request->only('fiscal_year');
        return response()->json($this->requisitions->getResults($requisition_type_id, $project_id, $activity_id, $region_id, $fiscal_year));
    }

    public function description(Request $request, Requisition $requisition)
    {
        $mdh_rates = $this->mdh_rates->getForPluck();
        $description = $request->input('description');
        $numeric_out_put = $request->input('numeric_out_put');
        $uuid = $request->input('uuid');
        DB::update('update requisitions set descriptions = ?, numeric_output = ? where uuid = ?',[$description,$numeric_out_put, $uuid]);

        return redirect()->route('requisition.initiate',[$requisition])
            ->with('mdh_rates',$mdh_rates->all());
    }
    public function detailed(){

        return view('requisition._parent.detailed');
    }
    public function updateActualAmount(Requisition $requisition)
    {
        $this->requisitions->updateActualAmount($requisition);
        return redirect()->back();

    }

    public function addDescription(Requisition $requisition)
    {
        return view('requisition.description.forms.create')
            ->with('requisition', $requisition);
    }
    
    public function workflowSubmit(Requisition $requisition)
    {
        DB::transaction(function () use ($requisition){
            $this->requisitions->updateDoneAssignNextUserIdAndGenerateNumber($requisition);
            $wf_module_group_id = 1;
            $next_user = null;
            switch($requisition->type)
            {
                case 1:
                    $next_user_id = $requisition->activity->subProgram->users()->first();
                    if(!$next_user_id){
                        throw new GeneralException('Sub Program Area Manager not assigned');
                    }
                    $next_user = $next_user_id->id;
                    break;
            }
            event(new NewWorkflow(['wf_module_group_id' => $wf_module_group_id, 'resource_id' => $requisition->id,'region_id' => $requisition->region_id, 'type' => $requisition->type],[],['next_user_id' => $next_user]));
        });
    }
}