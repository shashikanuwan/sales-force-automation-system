<?php

namespace App\Http\Requests\Admin;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->hasRole(Role::ROLE_ADMIN);
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'address' => 'required|string|unique:users',
            'phone_number' => 'required|min:10|numeric|regex:/^[A-Za-z0-9_]+$/|unique:users',
            'email' => 'required|max:255|nullable|email',
            'user_id' => 'required|numeric|exists:users,id',
        ];
    }
}
