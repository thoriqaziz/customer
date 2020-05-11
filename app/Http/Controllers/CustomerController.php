<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Http\Requests\CustomerRequest;
use App\Http\Resources\Customer as CustomerResource;

class CustomerController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Customer::class);

        $customer = Customer::all();

        return CustomerResource::collection($customer);
    }

    public function create()
    {
        //
    }

    public function store(CustomerRequest $request)
    {
        $customer = $request->user()->customers()->create($request->validated());

        return (new CustomerResource($customer))
            ->response()
            ->setStatusCode(201);

    }

    public function show(Customer $customer)
    {
        $this->authorize('viewAny', $customer);

        return new CustomerResource($customer);
    }

    public function edit($id)
    {
        //
    }

    public function update(CustomerRequest $request, Customer $customer)
    {
        $this->authorize('update', $customer);

        $customer->update($request->validated());

        return (new CustomerResource($customer))
                ->response()
                ->setStatusCode(200);
    }

    public function destroy(Customer $customer)
    {
        $this->authorize('delete', $customer);

        $customer->delete();

        return response([], 204);
    }
}
