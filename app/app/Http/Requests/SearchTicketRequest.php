<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'start_point' => 'required',
            'end_point' => 'required'
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
            'start_point' => 'Điểm xuất phát',
            'end_point' => 'Điểm đến',
        ];
    }
}
