<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassroomRequest extends FormRequest
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
                    'list_classes.*.name' => 'required',
                    'list_classes.*.name_class_en' => 'required',
                ];
            }

            case 'PUT';
            case 'PATCH';
            {
                return [
                    'list_classes.*.name' => 'required',
                    'list_classes.*.name_class_en' => 'required',
                ];
            }
        }
    }

    public function messages()
    {
        return [
            '.name.required' => __('validation.required'),
            'name_class_en.required' => __('validation.required'),
        ];
    }
}
