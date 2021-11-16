<?php

namespace App\Http\Requests\Requisition\Equipment;

use Illuminate\Foundation\Http\FormRequest;

class EquipmentRequest extends FormRequest
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
            case 'POST':
                return [
                    'equipment_type' => 'required',
                    'title' => 'required:unique:requisition',
                    'specs' => 'required',
                    'price_from' => 'required',
                    'price_to' => 'required',
                ];
            case 'PUT':
                return [
                    'equipment_type' => 'required',
                    'title' => 'required',
                    'specs' => 'required',
                    'price_from' => 'required',
                    'price_to' => 'required',
                ];
        }
    }
}
