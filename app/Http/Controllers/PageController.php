<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Resources\Customer as CustomerResource;

class PageController extends Controller
{
    public function index()
    {
        $data = request()->validate([
            'searchTerm' => 'required',
        ]);

        $customers = Customer::search($data['searchTerm'])->get();

        return CustomerResource::collection($customers);
    }
}
