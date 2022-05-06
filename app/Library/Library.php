<?php
/**
 * @developer: hamis
 * @email: hamisjuma1@icloud.com, hamisjuma1@gmail.com, hamisjuma1@yahoo.com
 * @vendor: Lynrant inc
 * Date: 12/15/19
 * Time: 6:37 PM
 */
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use App\Models\Auth\User;




if (!function_exists('get_uri')) {
    /**
     * Determine the requested url path name
     *
     * @return string
     */
    function get_uri() {
        return urldecode(
            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
        );
    }
}

if (!function_exists('asset_url')) {

    /**
     * Return the assets folder url of this application
     *
     * @return string
     */
    function asset_url() {
        return url("/");
    }

}

if (!function_exists('public_url')) {

    /**
     * Return the public url of the application
     *
     * @return type string
     */
    function public_url() {
        return url("/");
    }

}

if (! function_exists('includeRouteFiles')) {
    /**
     * Loops through a folder and requires all PHP files
     * Searches sub-directories as well.
     *
     * @param $folder
     */
    function includeRouteFiles($folder)
    {
        try {
            $rdi = new recursiveDirectoryIterator($folder);
            $it = new recursiveIteratorIterator($rdi);

            while ($it->valid()) {
                if (! $it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                    require $it->key();
                }

                $it->next();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}


if (!function_exists('getFallbackLocale')) {

    /**
     * Get the fallback locale
     *
     * @return \Illuminate\Foundation\Application|mixed
     */
    function getFallbackLocale() {
        return config('app.fallback_locale');
    }

}

if (!function_exists('getLanguageBlock')) {

    /**
     * Get the language block with a fallback
     *
     * @param $view
     * @param array $data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function getLanguageBlock($view, $data = []) {
        $components = explode("lang", $view);
        $current = $components[0] . "lang." . app()->getLocale() . "." . $components[1];
        $fallback = $components[0] . "lang." . getFallbackLocale() . "." . $components[1];

        if (view()->exists($current)) {
            return view($current, $data);
        } else {
            return view($fallback, $data);
        }
    }

}


if (! function_exists('access')) {
    /**
     * Access (lol) the Access:: facade as a simple function.
     */
    function access()
    {
        return app('access');
    }
}

if (! function_exists('sysdef')) {
    /**
     * Access (lol) the Access:: facade as a simple function.
     */
    function sysdef()
    {
        return app('sysdef');
    }
}

if (! function_exists('code_value')) {
    /**
     * Access (lol) the Access:: facade as a simple function.
     */
    function code_value()
    {
        return app('code_value');
    }
}


if (! function_exists('sec_env')) {
    function sec_env($name, $fallback = '') {
        $env = require __DIR__. './../../config/env.php';
        $crypt  = new \Illuminate\Encryption\Encrypter($env["key"]);
        if (isset($_SERVER[$name])) {
            $password = $crypt->decrypt($_SERVER[$name]);
        } else {
            $password = $fallback;
        }
        return $password;
    }
}


/*
 * truncate to n characters of string
 */
if(! function_exists('truncateString')) {
    function truncateString($string, $stringLimit = 300){
        return str_limit($string, $stringLimit, $end = "...");
    }
}

/*
 * Generate random string with n number of characters, 3 is default, for reference [code_values]
 */
if(! function_exists('randomString')) {
    function randomString($chars = 3) {
        return strtoupper(str_random($chars));
    }
}


/* Number format with 2 decimal places with thousands separator 10,000.00*/

if (! function_exists('number_2_format')) {
    function number_2_format($value)
    {
        return  number_format( $value , 2, '.' , ',' );
    }
}


/* Number format with no decimal places with thousands separator 10,000 */

if (! function_exists('number_0_format')) {
    function number_0_format($value)
    {
        return  number_format( $value , 0, '.' , ',' );
    }
}

/*short date format D-M-Y*/
if (! function_exists('short_date_format')) {
    function short_date_format($date)
    {
        return \Carbon\Carbon::parse($date)->format('d-M-Y');
    }
}



/*Standard format date format Y-m-j for storing in the database*/
if (! function_exists('standard_date_format')) {
    function standard_date_format($date)
    {
        return \Carbon\Carbon::parse($date)->format('Y-n-j');
    }
}



/*Today's date*/
if (! function_exists('getTodayDate')) {

    function getTodayDate()
    {
        return \Carbon\Carbon::now()->format('Y-n-j');

    }
}

/*System Launch date*/
if (! function_exists('getLaunchDate')) {
    function getLaunchDate()
    {
        $launch_date = '2018-11-01';
        return \Carbon\Carbon::parse($launch_date)->format('Y-n-j');
    }
}

/*add - after 3 characters, for TIN*/
if (! function_exists('chunk_hyphen')) {
    function chunk_hyphen($string){
        return implode("-", str_split($string, 3));
    }
}

/*capture the first word after dot (.)*/
if (! function_exists('capture_first')) {
    function capture_first($string){
        $arr = explode(".", $string, 2);
        return $first = $arr[0];
    }
}


/*Set side Menu Active link*/
if (!function_exists('setActive')) {
    function setActive($path)
    {
        return \Illuminate\Support\Facades\Request::is($path . '*') ? 'active' :  '';
    }
}

if (!function_exists('true_false_pluck')) {
    function true_false_pluck()
    {
        return [
            true => 'Active',
            false => 'In-Active'
        ];
    }
}

/**
 *
 */
if (!function_exists('check_available_budget_individual')) {
    function check_available_budget_individual(Model $model, $amount, $current_amount = null, $updated_amount = null)
    {
        return (new \App\Repositories\Requisition\RequisitionRepository())->checkAvailableBudgetIndividual($model, $amount, $current_amount, $updated_amount);
    }
}
if (!function_exists('getNoDays')) {
    function getNoDays($from, $to)
    {
        return (new \App\Repositories\Requisition\RequisitionRepository())->getNoDays($from, $to);
    }
}


if (!function_exists('currency_converter')) {
    function currency_converter($amount, $currency)
    {
        $rate = (new \App\Repositories\Rate\RateRepository())->getQuery()->where('active', true);

        if($rate->count() == 0){
            throw new \App\Exceptions\GeneralException($currency. ' There is no exchange rate. Please contact Finance department to set exchange Rate');
        }
        if(!is_numeric($amount)){
            throw new \App\Exceptions\GeneralException($currency. ' Please enter amount');
        }
        $converted = null;
        switch($currency)
        {
            case 'TSH':
                $converted = $amount/$rate->first()->amount;
                break;
            case 'USD':
                $converted = $amount * $rate->first()->amount;
                break;
            default:
                throw new \App\Exceptions\GeneralException($currency. ' Does not exist. You can use either TSH or USD');
                break;
        }

        return $converted;
    }
}

if (!function_exists('active_rate_id')) {
    function active_rate_id()
    {
        return (new \App\Repositories\Rate\RateRepository())->getActive()->id;
    }
}
