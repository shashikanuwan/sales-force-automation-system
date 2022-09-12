<?php

namespace App\Http\Requests\Admin;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class LineFreeRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->hasRole(Role::ROLE_ADMIN);
    }

    public function rules()
    {
        return [
            'label' => 'required',
            'type' => 'required|in:Flat,Multiple',
            'product_id' => 'required|integer|exists:products,id',
            'lower_limit' => 'required|string',
            'uper_limit' => 'required|string',
            'quantity' => 'required|integer',
        ];
    }
}
