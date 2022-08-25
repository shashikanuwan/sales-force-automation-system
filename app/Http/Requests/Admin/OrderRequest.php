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
            'remark' => 'sometimes|nullable',
            'quantity' => 'required|numeric',
            'user_id' => 'required|numeric|exists:users,id',
            'sku_id' => 'required|numeric|exists:skus,id',
        ];
    }
}
