<?php

namespace App\Exports;

use App\Models\Attendance\ActivityAttendance;
use App\Repositories\Attendance\ActivityAttendanceRepository;
use App\Repositories\Hotspot\HotspotRepository;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ActivityReportAttendancesExport implements FromCollection, WithMapping, WithHeadings
{
    protected $activity_attendance;
    protected $hotspots;
    protected $activity_report;

    public function __construct($activity_report)
    {
        $this->activity_report =  $activity_report;
        $this->hotspots =  (new HotspotRepository());
        $this->activity_attendance =  (new ActivityAttendanceRepository());
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $hotspots =  $this->hotspots->getHotspotByReportId($this->activity_report->id)->get();
        foreach ($hotspots as $hotspot)
        {
            return  $this->activity_attendance->getGOfficerAttendancesByHotspotId($hotspot->id);
        }
//        return ActivityAttendance::all();
    }
    public function map($row): array
    {
        return [
            $row->gOfficer->first_name,
            $row->gOfficer->last_name,
            substr($row->gOfficer->mobile, -9),
            $row->checkin_time,
            $row->checkout_time,
            $row->checkin_location,
            $row->checkout_location,
            $row->camp,
            getNoHours($row->checkin_time, $row->checkout_time)

        ];
    }

    public function headings(): array
    {
        return [
            'First Name',
            'Last Name',
            'Phone',
            'Checkin Time',
            'Checkout Time',
            'Checkin Location',
            'Checkout Location',
            'Hotspot Name',
            'Working hours'
        ];
    }
}
