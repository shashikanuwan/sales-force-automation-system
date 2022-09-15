<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class CustomerOrderRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->hasRole(Role::ROLE_DISTRIBUTOR) or $this->user()->hasRole(Role::ROLE_DISTRIBUTOR);;
    }

    public function rules()
    {
        return [
            'quantities.*' => 'required|numeric',
            'customer_id' => 'required|exists:customers,id',
            'product_ids' => 'required|exists:products,id',
            'deliver_date' => 'required|date|after:today',
        ];
    }
}
