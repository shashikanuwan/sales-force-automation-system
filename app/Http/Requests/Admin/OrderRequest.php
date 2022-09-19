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
            'product_ids' => 'required|exists:skus,id',
            'user_id' => 'required|exists:users,id',
            'quantities.*' => 'required|numeric',
            'deliver_date' => 'required|date|after:today',
        ];
    }
}
