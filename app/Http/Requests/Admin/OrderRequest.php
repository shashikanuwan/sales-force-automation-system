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
            'remarks' => 'sometimes|nullable',
            'quantities' => 'required|array',
            'user_ids' => 'required|exists:users,id|array',
            'sku_ids' => 'required|exists:skus,id|array',
            'deliver_dates' => 'required|array',
        ];
    }
}
