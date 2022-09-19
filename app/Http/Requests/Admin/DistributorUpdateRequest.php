<?php

namespace App\Http\Requests\Admin;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DistributorUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->hasRole(Role::ROLE_ADMIN);
    }

    public function rules()
    {
        $unique = Rule::unique('users')->ignore($this->distributor->id);
        return [
            'name' => 'required|string',
            'territory_id' => 'required|exists:territories,id',
            'user_name' => ['required', 'string', 'regex:/^[A-Za-z0-9-]+$/', $unique],
            'nic' => ['required', 'min:10', 'max:12', 'string', 'regex:/^[A-Za-z0-9_]+$/', $unique],
            'address' => ['required', 'string', $unique],
            'phone_number' => ['required', 'min:10', 'numeric', 'regex:/^[A-Za-z0-9_]+$/',  $unique],
            'email' => ['sometimes', 'nullable', 'email', 'max:255', $unique],
            'gender' => 'sometimes|in:Male,Female|nullable',
        ];
    }
}
