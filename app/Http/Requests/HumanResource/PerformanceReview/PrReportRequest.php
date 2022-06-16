<?php

namespace App\Http\Requests\HumanResource\PerformanceReview;

use Illuminate\Foundation\Http\FormRequest;

class PrReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required',
            'from_at' => 'required',
            'to_at' => 'required|after:from_at'
        ];
    }
}
