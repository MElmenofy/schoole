<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GradeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        switch ($this->method()) {
            case 'POST';
            {
                return [
                    'name' => 'required|unique:grades,name->ar,',
                    'name_en' => 'required|unique:grades,name->en,',
                    'note' => 'nullable',
                ];
            }

            case 'PUT';
            case 'PATCH';
            {
                return [
                    'name' => 'required|unique:grades,name->ar,'.$this->id,
                    'name_en' => 'required|unique:grades,name->en,'.$this->id,
                    'note' => 'nullable',
                ];
            }
        }
    }

    public function messages()
    {
        return [
            'name.required' => __('validation.required'),
            'name.unique' => __('validation.unique'),
            'name_en.required' => __('validation.required'),
            'name_en.unique' => __('validation.unique'),
        ];
    }
}
