<?php

namespace App\Repositories\HumanResource\Interview;

use App\Exceptions\GeneralException;
use App\Models\Auth\User;
use App\Models\Budget\FiscalYear;
use App\Models\HumanResource\Interview\Interview;
use App\Models\HumanResource\Interview\InterviewQuestion;
use App\Models\HumanResource\Interview\Question;
use App\Notifications\Workflow\WorkflowNotification;
use App\Repositories\BaseRepository;
use App\Services\Generator\Number;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use League\Flysystem\Plugin\PluggableTrait;

class InterviewQuestionRepository extends BaseRepository
{
    const MODEL = InterviewQuestion::class;

    use Number;

    public function getQuery()
    {
        return $this->query();
    }

    public function getAll()
    {
        return $this->getQuery();
    }


    public function store($input){
       return $this->query()->create($input);
    }
   
}
