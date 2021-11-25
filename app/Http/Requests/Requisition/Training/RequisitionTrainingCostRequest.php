<?php

namespace App\Http\Requests\Requisition\Training;

use Illuminate\Foundation\Http\FormRequest;

class RequisitionTrainingCostRequest extends FormRequest
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
            'description' => 'required',
            'transportation' => 'required',
            'other_cost' => 'required',
        ];
    }
}
