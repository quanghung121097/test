<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class RegisterRequest extends FormRequest
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
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'password' => 'required|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute là bắt buộc',
            'unique' => ':attribute đã tồn tại',
            'email' => ':attribute k đúng định dạng',
            'min' => ':attribute ít nhất 8 ký tự',
            'confirmed' => ':attribute chưa được xác thực',
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
            'password' => 'mật khẩu'
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
