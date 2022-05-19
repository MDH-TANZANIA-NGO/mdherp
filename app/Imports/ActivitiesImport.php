<?php

namespace App\Imports;

use App\Models\Project\Activity;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use App\Repositories\Project\SubProgramRepository;
use App\Repositories\Project\OutputUnitRepository;

class ActivitiesImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    protected $subProgramRepository,$outputUnitRepository;
    public function __construct(){
        $this->subProgramRepository = new SubProgramRepository();
        $this->outputUnitRepository = new OutputUnitRepository();
    }

    public function model(array $row)
    {
        # Validate subprogram 
        $subprogram = $this->subprogram($row['sub_program']);       
        if(!$subprogram){
            return null;
        }
        # Validate output unit / if not exist, create one
        $outputunit = $this->outputUnit($row['output_unit']);     
        if(!$outputunit){
            return null;
        }

        return new Activity([
            'sub_program_id' => $subprogram ,
            'description' => $row['description'],
            'title' => $row['title'],
            'code' => $row['code'],
            'output_unit_id' => $outputunit,
        ]);
    }

    public function outputUnit($outputunit){
        $data = $this->outputUnitRepository->query()->where('title','like','%'.$outputunit.'%')->first();
        if($data) return $data->id;
        return $this->outputUnitRepository->store(['title'=>$outputunit])->id;   
    }

    public function subprogram($subprogram_id){
        $data = $this->subProgramRepository->query()->where('title',$subprogram_id)->first();
        if(!$data) return null;
        return $data->id;
    }

   
}
