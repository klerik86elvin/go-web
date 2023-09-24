<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class NewsRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'title' => ['required'],
            'description' => ['required'],
            'translations' => ['array', 'distinct:lang'],
            'translations.*.lang' =>['required','exists:App\Models\Locale,name'],
            'translations.*.title' =>['required'],
            'translations.*.description' =>['required']
        ];
        if ($this->isMethod('put')){
            $rules['status'] = ['required','boolean'];
        }
        return $rules;
    }
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => $validator->errors()], 422));
    }

}
