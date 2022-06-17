<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
        switch ($this->method())
        {
            case "POST":
                return [
//                    'code' => 'required|unique:projects',
//                    'title' => 'required|unique:projects',
//                    'description' => 'required',
//                    'start_year' => 'required|date',
//                    'end_year' => 'required|date',
//                    'fund' => 'required'
                ];
                break;
        }
    }
}
