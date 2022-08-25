<?php

namespace App\Http\Requests\Admin;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class distributorRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->hasRole(Role::ROLE_ADMIN);
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'user_name' => 'required|string|regex:/^[A-Za-z0-9-]+$/|unique:users',
            'nic' => 'required|min:10|max:12|string|regex:/^[A-Za-z0-9_]+$/|unique:users',
            'address' => 'required|string|unique:users',
            'phone_number' => 'required|min:10|numeric|regex:/^[A-Za-z0-9_]+$/|unique:users',
            'email' => 'sometimes|max:255|nullable|email',
            'gender' => 'sometimes|in:Male,Female|nullable',
            'territory_id' => 'required|numeric|exists:territories,id',
            'password' => 'required|min:8|confirmed',
        ];
    }
}
