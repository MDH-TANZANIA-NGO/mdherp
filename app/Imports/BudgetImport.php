<?php

namespace App\Imports;

use App\Models\Budget\Budget;
use App\Models\Project\Activity;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use App\Repositories\Project\SubProgramRepository;
use App\Repositories\Project\OutputUnitRepository;
use App\Repositories\Project\ActivityRepository;

class BudgetImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    protected $subProgramRepository,$outputUnitRepository,$activityRepository;
    protected $importedRowCount = 0;
    protected $duplicate = 0;
    public function __construct(){
        $this->subProgramRepository = new SubProgramRepository();
        $this->outputUnitRepository = new OutputUnitRepository();
        $this->activityRepository = new ActivityRepository();
    }

    public function model(array $row)
    {
        # Validate subprogram 
        // $subprogram = $this->subprogram($row['sub_program']);       
        // if(!$subprogram) return null;
           
        # Validate output unit / if not exist, create one
        // $outputunit = $this->outputUnit($row['output_unit']);     
        // if(!$outputunit) return null;

        # Filter duplicates 
        // $activitycode = $this->activityRepository->query()->where('code',$row['code'])->first();
        // if($activitycode){
        //     $this->duplicate += 1;
        //     return null;
        // }
        $this->importedRowCount += 1;
        $activityid = $this->filterActivity($row['title']);
        if(!$activityid){
            return null;
        }
        return new Budget([
            'region_id' => $row['region_id'],
            'fiscal_year_id' => 1,
            'activity_id' => $activityid,
            'amount' => $row['amount'],
            'actual_amount' => $row['actual_amount'],
            'numeric_output' => $row['numeric_output'],
            'rate_id' => 1,
        ]);
    }

    private function outputUnit($outputunit){
        $data = $this->outputUnitRepository->query()->where('title','like','%'.$outputunit.'%')->first();
        if($data) return $data->id;
        return null;
    }

    private function subprogram($subprogram_id){
        $data = $this->subProgramRepository->query()->where('title',$subprogram_id)->first();
        if(!$data) return null;
        return $data->id;
    }

    private function filterActivity($title){
        $data = $this->activityRepository->query()->where('title','like','%'.$title.'%')->first();
        if(!$data) return null;
        return $data->id;
    }


    public function getImportedRowsCount(){
        return $this->importedRowCount;
    }

    public function getDuplicateRowsCount(){
        return $this->duplicate;
    }
  
}
