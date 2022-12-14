<?php

namespace App\Http\Requests\Distributor;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class DistributorOrderRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->hasRole(Role::ROLE_DISTRIBUTOR);
    }

    public function rules()
    {
        return [
            'remark' => 'sometimes|nullable',
            'product_ids' => 'required|exists:skus,id',
            'quantities.*' => 'required|numeric',
            'deliver_date' => 'required|date|after:today',
        ];
    }
}
