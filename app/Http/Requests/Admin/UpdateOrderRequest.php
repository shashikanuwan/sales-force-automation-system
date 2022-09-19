<?php

namespace App\Http\Requests\Admin;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->hasRole(Role::ROLE_ADMIN);
    }

    public function rules()
    {
        return [
            'remark' => 'sometimes|nullable',
            'user_id' => 'required|exists:users,id',
            'deliver_date' => 'required|date|after:today',
        ];
    }
}
