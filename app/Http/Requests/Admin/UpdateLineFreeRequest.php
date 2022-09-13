<?php

namespace App\Http\Requests\Admin;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLineFreeRequest extends FormRequest
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
            'purchase_quantity' => 'required|integer',
            'free_quantity' => 'required|integer',
            'lower_limit' => 'required|integer',
            'uper_limit' => 'required|integer',
        ];
    }
}
