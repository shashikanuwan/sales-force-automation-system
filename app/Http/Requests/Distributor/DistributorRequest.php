<?php

namespace App\Http\Requests\Distributor;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class DistributorRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->hasRole(Role::ROLE_DISTRIBUTOR);
    }

    public function rules()
    {
        return [];
    }
}
