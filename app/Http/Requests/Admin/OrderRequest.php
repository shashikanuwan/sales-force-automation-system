<?php

namespace App\Http\Requests\Admin;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->hasRole(Role::ROLE_ADMIN);
    }

    public function rules()
    {
        return [
            'remarks.*' => 'sometimes|nullable',
            'quantities.*' => 'required|numeric',
            'user_ids' => 'required|exists:users,id',
            'sku_ids' => 'required|exists:skus,id',
            'deliver_dates.*' => 'required|date|after:today',
        ];
    }
}
