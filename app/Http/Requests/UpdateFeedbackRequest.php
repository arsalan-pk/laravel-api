<?php

namespace App\Http\Requests;

use App\Helpers\ApiValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class UpdateFeedbackRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'category' => 'required|in:bug,feature,improvement',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Title required.',
            'title.max' => 'Title  not be greater than :max characters.',
            'description.required' => 'Description required.',
            'description.max' => 'Description not be greater than :max characters.',
            'category.required' => 'Category required.',
            'category.in' => 'Invalid category.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        ApiValidation::invalid($validator->errors()->toArray());
    }
}
