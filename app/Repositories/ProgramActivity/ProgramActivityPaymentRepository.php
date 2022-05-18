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
//            'total_items_amount_paid'=>$input['total_items'],
            'total_participant_amount_paid'=>(int)$input['total_amount'],
            'total_amount_paid'=>(int)$input['total_amount'],


        ];
    }

    public function storeActivityPayment($input){
        return DB::transaction(function () use ($input){
            return $this->query()->create($this->inputProcessActivityPayment($input));
        });
    }
    public function updateActivityPayment($input){
        return DB::transaction(function () use ($input){
            return $this->query()->update($this->inputProcessActivityPayment($input));
        });
    }
}
