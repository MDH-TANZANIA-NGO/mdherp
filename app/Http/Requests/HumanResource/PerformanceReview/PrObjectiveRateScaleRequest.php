<?php

namespace App\Http\Requests\HumanResource\PerformanceReview;

use Illuminate\Foundation\Http\FormRequest;

class PrObjectiveRateScaleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'rate_scale' => 'required',
        ];
    }
}
