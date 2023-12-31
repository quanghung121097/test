<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class SearchTicketRequest extends FormRequest
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
            'start_location' => 'required',
            'end_location' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute là bắt buộc'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'start_location' => 'Điểm xuất phát',
            'end_location' => 'Điểm đến',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $json = [
            'success' => false,
            'message' => implode(', ', $validator->errors()->all())
        ];
        $response = response($json, 400);
        throw (new ValidationException($validator, $response))->status(400);
    }
}
