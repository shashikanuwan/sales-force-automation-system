<?php

namespace App\Http\Requests\Admin;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->hasRole(Role::ROLE_ADMIN);
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'mrp' => 'required|numeric',
            'weight' => 'required|numeric',
            'symbol' => 'required|string',
            'quantity' => 'required|integer',
            'distributor_price' => 'required|numeric',
            'category_id' => 'required|numeric|exists:categories,id',
        ];
    }
}
