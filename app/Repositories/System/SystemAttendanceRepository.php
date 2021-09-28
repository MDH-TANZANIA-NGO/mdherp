<?php


namespace App\Repositories\System;


use App\Models\System\SystemAttendance;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SystemAttendanceRepository extends BaseRepository
{
    const MODEL = SystemAttendance::class;

    public function attend($input)
    {
        $date = Carbon::parse($input)->format('Y-m-d');
        $time_stamp = $input;
        //check if there is checkin today
        if($this->checkIfThereIsCurrentAttendance($date)->count())
        {
            $this->checkOutCurrentAttendance($this->checkIfThereIsCurrentAttendance($date)->first(), $time_stamp);
        }else{
            $this->checkIn($time_stamp);
        }
    }

    /**
     * check If There Is Current Attendance
     * @param $time
     * @return mixed
     */
    public function checkIfThereIsCurrentCompletedAttendance($date)
    {
        return $this->query()->where('user_id', access()->id())->where('complete', 1)->whereDate('checkin_time', '=', $date);
    }

    /**
     * check If There Is Current Attendance
     * @param $time
     * @return mixed
     */
    public function checkIfThereIsCurrentAttendance($time)
    {
        return $this->query()->where('user_id', access()->id())->where('complete', 0)->whereDate('checkin_time', '=', $time);
    }

    /**
     * check Out Current Attendance
     * @param $date
     * @param $time_stamp
     * @return mixed
     */
    public function checkOutCurrentAttendance(SystemAttendance $systemAttendance, $time_stamp)
    {
        return DB::transaction(function () use ($systemAttendance, $time_stamp){
            return $systemAttendance->update([
                'checkout_time' => $time_stamp,
                'complete' => 1
            ]);
        });
    }

    public function checkIn($time_stamp)
    {
        return DB::transaction(function () use ($time_stamp){
            return $this->query()->create([
                'checkin_time' => $time_stamp,
                'user_id' => access()->id()
            ]);
        });
    }

    public function getQuery()
    {
        return $this->query()->select([
            'system_attendances.checkin_time AS checkin_time',
            'system_attendances.checkout_time AS checkout_time',
        ])
            ->join('users', 'users.id','system_attendances.user_id');
    }

    public function getAttendancesByUserAndDateRange($user_id,$checkin_time, $checkout_time)
    {
        return $this->getQuery()
            ->where('system_attendances.user_id', $user_id)
            ->whereBetween('system_attendances.checkin_time',[$checkin_time, $checkout_time])
            ->get();
    }

}
