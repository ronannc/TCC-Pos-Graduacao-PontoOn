<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeResquest extends FormRequest
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
            'name'             => 'required|string|max:100',
            'date_admission'   => 'required|date',
            'date_resignation' => 'date',
            'mother_name'      => 'max:100|string',
            'cpf'              => 'max:15|unique:employees,cpf',
            'email'            => 'email| max:200|unique:employees,email',
            'syndicate_id'     => 'required',
            'timetabling_id'   => 'required',
            'company_id'       => 'required',
        ];
    }
}
