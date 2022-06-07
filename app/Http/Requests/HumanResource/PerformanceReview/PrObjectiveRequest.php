<?php

namespace App\Http\Requests\HumanResource\PerformanceReview;

use Illuminate\Foundation\Http\FormRequest;

class PrObjectiveRequest extends FormRequest
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
        switch($this->method())
        {
            case 'POST': case 'PUT':
                return [
                    'goal' => 'required|min:10',
                    'plan' => 'required|min:10',
                ];
            break;
        }
    }
}
