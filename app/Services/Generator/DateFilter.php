<?php


namespace App\Services\Generator;


use App\Repositories\System\HolidayRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

trait DateFilter
{
    public function filterDate($leave_type, $start_date, $end_date)
    {
        $date_between = getDatesBetweenRange($start_date, $end_date);
        $dates_without_weekends = $this->removeWeekends($date_between);
        $dates_without_holidays = $this->removeHolidays($dates_without_weekends);

        if($leave_type == 1 || $leave_type == 2){
            return [
                'dates' => $dates_without_holidays,
                'number_of_days' => $this->countDays($dates_without_holidays)
            ];
        }else{
            return [
                'dates' => $date_between,
                'number_of_days' => $this->countDays($date_between)
            ];
        }
        
    }

    /**
     * Remove Weekends
     * @param $dates
     * @return array
     */
    private function removeWeekends($dates)
    {
        $weekends = [];
        foreach($dates as $date){
            $day = Carbon::parse($date);
            if(!$day->isSaturday() and !$day->isSunday()){
                array_push($weekends, $day->format('Y-m-d'));
            }
        }
        return $weekends;
    }

    /**
     * Remove Holidays
     * @param $dates
     * @return mixed
     */
    private function removeHolidays($dates)
    {
        $holiday_repo = (new HolidayRepository());
        $holidays = $holiday_repo->getCurrent();
        foreach ($holidays as $holiday){
            if (($key = array_search($holiday->date, $dates)) !== false) {
                unset($dates[$key]);
            }
        }
        return $dates;
    }

    private function countDays($dates)
    {
        return sizeof($dates);
    }
}
