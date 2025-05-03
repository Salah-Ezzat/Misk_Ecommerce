<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
    public function rules(): array
    {
        $rules = [
            'shop' => ['required', 'string'],
            'name' => ['required', 'string'],
            'province' => ['required', 'string'],
            'city' => ['required', 'string'],
            'address' => ['required', 'string'],
            'cover' => ['nullable',  'array'],
            'role_id' => ['required', 'exists:roles,id'],
            'code' => ['string'],
            'min_limit' => ['integer'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048']
        ];

        if ($this->isMethod('post')) {
            // حالة الإضافة
            $rules['phone'] = ['required', 'digits:11', 'regex:/^(010|011|012|015)[0-9]{8}$/', 'unique:users,phone'];
            $rules['password'] = 'required|min:4|confirmed';
        } elseif ($this->isMethod('PUT') || $this->isMethod('patch')) {
            // حالة التعديل
            $userId = $this->route('user');
            $rules['phone'] = ['required', 'digits:11', 'regex:/^(010|011|012|015)[0-9]{8}$/',  Rule::unique('users', 'phone')->ignore($userId),];
            $rules['password'] = 'nullable|min:4|confirmed';
        }

        return $rules;
    }
}
