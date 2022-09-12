<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Http\Requests\Admin\CustomerRequest;
use App\Models\Customer;
use App\Models\User;

class CustomerController extends Controller
{
    public function index()
    {
        return view('Admin.Customer.index');
    }

    public function create()
    {
        return view('Admin.Customer.create');
    }

    public function store(CustomerRequest $request)
    {
        $code = Helper::IDGenerator(new Customer(), 'code', 2, 'CUST');

        $customer = new Customer();
        $customer->name = $request->get('name');
        $customer->address = $request->get('address');
        $customer->phone_number = $request->get('phone_number');
        $customer->email = $request->get('email');
        $customer->code = $code;
        $customer->user_id = $request->get('user_id');
        $customer->save();

        return redirect()
            ->route('customer.index')
            ->with('success', 'New Customer has been created');
    }

    public function edit(AdminRequest $request, Customer $customer)
    {
        return view('Admin.Customer.edit')
            ->with([
                'customer' => $customer,
                'distributors' => User::query()->role('distributor')->get()
            ]);
    }

    public function update(CustomerRequest $request, Customer $customer)
    {
        $customer->update($request->validated());

        return redirect()
            ->route('customer.index')
            ->with('success', 'Customer has been updated');
    }

    public function destroy(AdminRequest $request, Customer $customer)
    {
        $customer->delete();

        return back()
            ->with('success', 'Customer has been deleted');
    }
}
