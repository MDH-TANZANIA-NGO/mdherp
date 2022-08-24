<?php

namespace App\Repositories\ProgramActivity;

use App\Models\ProgramActivity\ProgramActivityPayment;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class ProgramActivityPaymentRepository extends BaseRepository
{
    const MODEL =  ProgramActivityPayment::class;
    public function __construct()
    {
        //
    }

    public function inputProcessActivityPayment($input){
        return [
            'program_activity_report_id'=>(int)$input['program_activity_report_id'],
            'amount_requested'=>(int)$input['requested_amount'],
            'program_activity_id'=>$input['program_activity_id'],
            'activity_report_id'=>$input['activity_report_id'],
            'total_participant_amount_paid'=>(int)$input['total_amount'],
            'total_amount_paid'=>(int)$input['total_amount'],


        ];
    }

    public function storeActivityPayment($input){
        return DB::transaction(function () use ($input){
            return $this->query()->create($this->inputProcessActivityPayment($input));
        });
    }
    public function updateActivityPayment($input, $uuid){
        return DB::transaction(function () use ($input, $uuid){
           $program_activity_payment =  $this->findByUuid($uuid);
            return $program_activity_payment->update($this->inputProcessActivityPayment($input));
        });
    }
}
