<?php


namespace App\Services\Generator;


use App\Exceptions\GeneralException;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

trait Number
{
    /**
     * @param Model $model
     * @return mixed
     * @throws GeneralException
     */
    public function generateNumber(Model $model)
    {
        switch ($model->getTable()) {
            case 'requisitions':
                #generate Reference number
                $reference = "REQNUM";
                $year = $this->year();
                $value = $this->getSysDefCurrentValue($reference);
                $number = "MDH-R-" . $year . $value;
                return $this->getSpecific($model, $reference, $value, $number);
                break;
            case 'safari_advances':
                $reference = "SAFNUM";
                $year = $this->year();
                $value = $this->getSysDefCurrentValue($reference);
                $number = "MDH-S-" . $year . $value;
                return $this->getSpecific($model, $reference, $value, $number);
                break;
            case 'retirements':
                $reference = "RETIREMENTSAFARINUM";
                $year = $this->year();
                $value = $this->getSysDefCurrentValue($reference);
                $number = "MDH-RT-" . $year . $value;
                return $this->getSpecific($model, $reference, $value, $number);
                break;
            case 'program_activities':
                #generate Reference number
                $reference = "PROGRAMACTIVITYNUM";
                $year = $this->year();
                $value = $this->getSysDefCurrentValue($reference);
                $number = "MDH-P-A-" . $year . $value;
                return $this->getSpecific($model, $reference, $value, $number);
                break;
            case 'payments':
                #generate Reference number
                $reference = "PAYMENTNUM";
                $year = $this->year();
                $value = $this->getSysDefCurrentValue($reference);
                $number = "MDH-F-" . $year . $value;
                return $this->getSpecific($model, $reference, $value, $number);
                break;

            case 'program_activity_reports':
                #generate Reference number
                $reference = "PROGRAMCTIVITYREPORTNUM";
                $year = $this->year();
                $value = $this->getSysDefCurrentValue($reference);
                $number = "MDH-PA-R-" . $year . $value;
                return $this->getSpecific($model, $reference, $value, $number);
                break;
            case 'rates':
                #generate Reference number
                $reference = "RATENUM";
                $year = $this->year();
                $value = $this->getSysDefCurrentValue($reference);
                $number = "MDH-RT-" . $year . $value;
                return $this->getSpecific($model, $reference, $value, $number);
                break;
            case 'g_officers':
                #generate Reference number
                $reference = "CHECKNO";
                $year = $this->year();
                $month = $this->month();
                $value = $this->getSysDefCurrentValue($reference);
                $number = '-' . $month . '-' . $year . '-' . $value;
                return $this->getSpecific($model, $reference, $value, $number);
                break;
            case 'hr_hire_requisitions':
                #generate Reference number
                $reference = "CHECKNO";
                $year = $this->year();
                $month = $this->month();
                $value = $this->getSysDefCurrentValue($reference);
                $number = 'MDH-HR-' . $month . '-' . $year . '-' . $value;
                return $this->getSpecific($model, $reference, $value, $number);
                break;

            case 'pr_reports':
                $reference = "PRNUM";
                $year = $this->year();
                $value = $this->getSysDefCurrentValue($reference);
                $number = "MDH-PR-" . $year . '-' . $value;
                return $this->getSpecific($model, $reference, $value, $number);
                break;

            case 'hr_hire_advertisement_requisitions':
                $reference = "HRADV";
                $year = $this->year();
                $value = $this->getSysDefCurrentValue($reference);
                $number = "MDH-HRADV-" . $year . '-' . $value;
                return $this->getSpecific($model, $reference, $value, $number);
                break;

            case 'hr_hire_requisition_job_shortlists':
                $reference = "HRJOBSHORT";
                $year = $this->year();
                $value = $this->getSysDefCurrentValue($reference);
                $number = "MDH-HRJS-" . $year . '-' . $value;
                return $this->getSpecific($model, $reference, $value, $number);
                break;
            case 'hr_interview_applicants':
                $reference = "MDH-INT";
                $year = $this->year();
                $value = $this->getSysDefCurrentValue($reference);
                $number = "MDH-INT-" . $year . '-' . $value;
                return $this->getSpecific($model, $reference, $value, $number);
                break;

            case 'hr_user_hire_requisition_job_shortlister_requests':
                $reference = "MDH_JSR";
                $year = $this->year();
                $value = $this->getSysDefCurrentValue($reference);
                $number = "MDH_JSR-" . $year . '-' . $value;
            case 'job_offers':
                $reference = "MDH-JOB-OFFER";
                $year = $this->year();
                $value = $this->getSysDefCurrentValue($reference);
                $number = "MDH-JOB-OFFER-" . $year . '-' . $value;
                return $this->getSpecific($model, $reference, $value, $number);
                break;
            case 'hr_interview_workflow_reports':
                $reference = "MDH-INT-REP";
                $year = $this->year();
                $value = $this->getSysDefCurrentValue($reference);
                $number = "MDH-INT-REP-" . $year . '-' . $value;
                return $this->getSpecific($model, $reference, $value, $number);
                break;
            case 'hr_interviews':
                $reference = "MDH-INT-NUM";
                $year = $this->year();
                $value = $this->getSysDefCurrentValue($reference);
                $number = "MDH-INT-NUM-" . $year . '-' . $value;
                return $this->getSpecific($model, $reference, $value, $number);
                break;
            case 'hr_hire_requisition_job_applicant_requests':
                $reference = "MDH-JAR-NUM";
                $year = $this->year();
                $value = $this->getSysDefCurrentValue($reference);
                $number = "MDH-JAR-" . $year . '-' . $value;
                return $this->getSpecific($model, $reference, $value, $number);
                break;
            case 'activity_reports':
                $reference = "MDH-ACT-RPT";
                $year = $this->year();
                $value = $this->getSysDefCurrentValue($reference);
                $number = "MDH-ACT-RPT" . $year . '-' . $value;
                return $this->getSpecific($model, $reference, $value, $number);
                break;
            default:
                throw new GeneralException(__('Number Not Set. Kindly contact system developer'));
                break;
        }
    }

    /**
     * @param Model $model
     * @param $reference
     * @param $value
     * @param $number
     * @return mixed
     * @throws GeneralException
     */
    public function getSpecific(Model $model, $reference, $value, $number)
    {
        #Update current value + 1
        $this->updateSysDefValue($reference, $value);

        // call the same function if the number exists already
        if ($this->checkIfNumberExists($model, $number)) {
            return $this->generateNumber($model);
        }
        // otherwise, it's valid and can be used
        return $number;
    }

    /**
     * Check if application number exist
     * @param $value
     * @return mixed
     */
    private function checkIfNumberExists(Model $model, $value)
    {
        return $model::query()->where('number', $value)->exists();
    }

    /**
     * Get New Number from System Definition
     * @param $reference
     * @return mixed
     */
    private function getSysDefCurrentValue($reference)
    {
        return DB::transaction(function () use ($reference) {
            $number = DB::table('sysdefs')
                ->where('reference', $reference)->first();
            return $number->value + 1;
        });
    }

    /**
     * Get New Value from System Definition
     * @param $reference
     * @param $value
     * @return mixed
     */
    private function updateSysDefValue($reference, $value)
    {
        return DB::transaction(function () use ($reference, $value) {
            return DB::table('sysdefs')
                ->where('reference', $reference)
                ->update(['value' => $value]);
        });
    }

    /**
     * @return int
     */
    private function year()
    {
        return Carbon::now()->format('y');
    }
    private function month()
    {
        return Carbon::now()->format('m');
    }
}
