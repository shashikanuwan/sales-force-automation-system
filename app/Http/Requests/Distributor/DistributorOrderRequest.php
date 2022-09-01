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
            'remarks.*' => 'sometimes|nullable',
            'quantities.*' => 'required|numeric',
            'sku_ids' => 'required|exists:skus,id',
            'deliver_dates.*' => 'required|date|after:today',
        ];
    }
}
