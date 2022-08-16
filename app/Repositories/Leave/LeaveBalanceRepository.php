<?php

namespace App\Repositories\Leave;

use App\Models\Leave\LeaveBalance;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class LeaveBalanceRepository extends  BaseRepository
{
    const  MODEL = LeaveBalance::class;
    public function __construct()
    {
        //
    }

    public function getQuery(){
        return $this->query()->select([
            DB::raw('leave_balances.id AS id'),
            DB::raw('leave_balances.user_id AS user_id'),
            DB::raw('leave_balances.leave_type_id AS leave_type_id'),
            DB::raw('leave_balances.remaining_days AS remaining_days'),
            DB::raw('leave_balances.created_at AS created_at'),
            DB::raw('leave_balances.updated_at AS updated_at'),
            DB::raw('leave_balances.fiscal_year_id AS fiscal_year_id'),
        ])
            ->join('fiscal_years', 'fiscal_years.id', 'leave_balances.fiscal_year_id')
            ->join('users','users.id', 'leave_balances.user_id');
    }

    public function getAccessLeaveBalance($user_id)
    {
        return $this->getQuery()
            ->where('leave_balances.user_id', $user_id);
    }

    public function getAccessLeaveBalanceByLeaveType($user_id, $leave_type_id)
    {
       return $this->getAccessLeaveBalance($user_id)
            ->where('leave_balances.leave_type_id', $leave_type_id)
           ->where('fiscal_years.active', true);
    }
}
