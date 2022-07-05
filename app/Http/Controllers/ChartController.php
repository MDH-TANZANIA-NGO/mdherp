<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\Models\Auth\User;
use App\Models\Timesheet\Timesheet;
use App\Models\Leave\Leave;

class ChartController extends Controller
{
    public function index()
    {


        $users = Timesheet::select('id', 'created_at')
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('m');
            });


        $usermcount = [];
        $timesheet = [];

        foreach ($users as $key => $value) {
            $usermcount[(int)$key] = count($value);
        }

        $month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        for ($i = 1; $i <= 12; $i++) {
            if (!empty($usermcount[$i])) {
                // $userArr[$i]['count'] = $usermcount[$i];
                array_push($timesheet, $usermcount[$i]);
            } else {
                array_push($timesheet, 0);;
            }
            // $userArr[$i]['month'] = $month[$i - 1];
        }






        $users = Leave::select('id', 'created_at')
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('m');
            });


        $usermcount = [];
        $leave = [];

        foreach ($users as $key => $value) {
            $usermcount[(int)$key] = count($value);
        }

        $month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        for ($i = 1; $i <= 12; $i++) {
            if (!empty($usermcount[$i])) {
                // $userArr[$i]['count'] = $usermcount[$i];
                array_push($leave, $usermcount[$i]);
            } else {
                array_push($leave, 0);;
            }
            // $userArr[$i]['month'] = $month[$i - 1];
        }

        return view('chart.index', ['month' => $month, 'timesheet' => json_encode($timesheet), 'leave' => json_encode($leave)]);
    }
}
