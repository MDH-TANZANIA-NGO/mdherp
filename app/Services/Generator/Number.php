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
        switch ($model->getTable())
        {
            case 'tafs':
                #generate Reference number
                $reference = "ICAPTAFNUM";
                $year = $this->year();
                $value = $this->getSysDefCurrentValue($reference);
                $number = "ICAP/TAF/".$year."/".$value;
                return $this->getSpecific($model, $reference, $value, $number);
                break;

            case 'tbers' :
                #generate Reference number
                $reference = "ICAPTBERNUM";
                $year = $this->year();
                $value = $this->getSysDefCurrentValue($reference);
                $number = "ICAP/TBER/".$year."/".$value;
                return $this->getSpecific($model, $reference, $value, $number);
                break;

                case 'cov_cec_monthly_payments' :
                    #generate Reference number
                    $reference = "ICAPCOVCECPAYNUM";
                    $year = $this->year();
                    $value = $this->getSysDefCurrentValue($reference);
                    $number = "ICAP/CCMP/".$year."/".$value;
                    return $this->getSpecific($model, $reference, $value, $number);
                    break;

                    case 'leaves' : 
                        #generate Reference number
                        $reference = "ICAPLENUM";
                        $year = $this->year();
                        $value = $this->year();
                        $value = $this->getSysDefCurrentValue($reference);
                        $number = "ICAP/LE/".$year."/".$value;
                        return $this->getSpecific($model, $reference, $value, $number);
                        break;
    
                default:
                    throw new GeneralException(__('exceptions.general.number_not_set'));
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
        $this->updateSysDefValue($reference,$value);

        // call the same function if the number exists already
        if ($this->checkIfNumberExists($number)) {
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
    private function checkIfNumberExists($value)
    {
        return $this->query()->where('number', $value)->exists();
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
    private function updateSysDefValue ($reference,$value)
    {
        return DB::transaction(function () use($reference,$value) {
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
}
