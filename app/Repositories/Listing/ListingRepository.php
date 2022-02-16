<?php

namespace App\Repositories\Listing;

use App\Models\Listing\Listing;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class ListingRepository extends BaseRepository
{
    const MODEL = Listing::class;

    public function getQuery(){
        return $this->query()->select([
            DB::raw('listings.id AS id' ),
            DB::raw('listings.number AS number' ),
            DB::raw('listings.uuid AS uuid' ),
            DB::raw('listings.title AS title' ),
            DB::raw('listings.content AS content' ),
            DB::raw('listings.budget AS budget' ),
            DB::raw('code_values.name AS establishment'),
            DB::raw('regions.name AS region'),
            DB::raw('departments.title AS department'),
            DB::raw('listings.education_and_qualification AS education'),
            DB::raw('listings.practical_experience AS experience'),
            DB::raw('listings.other_qualities AS qualities'),
            DB::raw('listings.special_employment_condition AS special'),
            DB::raw('listings.employee_id AS employee'),
            DB::raw('listings.created_at AS created_at' ),
            DB::raw('listings.date_required AS date_required' ),
            DB::raw('listings.updated_at AS updated_at' ),
            //DB::raw('working_tools AS working_tools')
        ])
            ->join('users','users.id', 'listings.user_id')
            ->join('departments', 'departments.id', 'listings.department_id')
            ->join('regions', 'regions.id', 'listings.region_id')
            ->join('code_values', 'code_values.id', 'listings.employment_condition_cv_id');
        // ->join('listing_working_tool', 'listing_working_tool.listing_id', 'listings.id')
        //->join('working_tools', 'listing_working_tool.working_tool_id', 'working_tools.id');

    }

    public function getAccessProcessingDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('listings.wf_done', 0)
            ->where('listings.rejected', null)
            ->where('users.id', access()->id());
    }
    public function getAccessRejectedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('listings.wf_done', 0)
            ->where('listings.rejected', true)
            ->where('users.id', access()->id());
    }

    public function getAccessProvedDatatable()
    {
        return $this->getQuery()
            ->whereHas('wfTracks')
            ->where('listings.wf_done', 0)
            ->where('listings.rejected', false)
            ->where('users.id', access()->id());
    }

    public function inputsProcessor($inputs): array
    {
        $md = new \ParsedownExtra();
        return [
            'user_id' => access()->id(),
            'region_id' => $inputs['region_id'],
            'department_id' => $inputs['department_id'],
            'title' => $inputs['title'],
            'number' => $inputs['number'],
            'date_required' => $inputs['date_required'],
            'employment_condition_cv_id' =>  $inputs['employment_condition_cv_id'],
            'special_employment_condition' => $md->text($inputs['special_employment_condition']),
            'other_qualities' => $md->text($inputs['other_qualities']),
            'education_and_qualification' => $md->text($inputs['education_and_qualification']),
            'practical_experience' => $md->text($inputs['practical_experience']),
            'establishment_cv_id' => $inputs['establishment_cv_id'],
            'budget' => $inputs['budget'] ?? NULL,
            'employee_id' => $inputs['employee_id'] ?? NULL,
            'prospect_for_appointment_cv_id' => $inputs['prospect_for_appointment_cv_id'],
            'content' => $md->text($inputs['content']),
        ];
    }

    public function store($inputs)
    {
        return DB::transaction(function () use ($inputs){
            $listing = $this->query()->create($this->inputsProcessor($inputs));
            if(isset($inputs['tools']))
                $listing->workingTools()->sync($inputs['tools']);
            return $listing;
        });
    }

}
