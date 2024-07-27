<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Http\Requests\CustomerRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $size = $request->input('size', 10);

        $customers = Customer::with('address')->paginate($size, ['*'], 'page', $page);

        return response()->json([
            'success'   => true,
            'data'      => $customers->items(),
            'meta'      => [
                'current_page'  => $customers->currentPage(),
                'last_page'  => $customers->lastPage(),
                'per_page'  => $customers->perPage(),
                'total'  => $customers->total(),
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {
        $customer = Customer::create($request->validated());
        return response()->json([
            "success"   => true,
            "data"      => $customer
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json([
                "success"   => false,
                "message"   => "Customer with id " . $id . " Not Found"
            ], 404);
        }

        return response()->json([
            "success"   => true,
            "data"      => $customer
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, string $id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json([
                "success"   => false,
                "message"   => "Customer with id " . $id . " Not Found"
            ], 404);
        }

        $customer->update($request->validated());
        return response()->json([
            "success"   => true,
            "data"      => $customer
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json([
                "success"   => false,
                "message"   => "Customer with id " . $id . " Not Found"
            ], 404);
        }

        $customer->delete();
        return response()->json(null, 204);
    }
}
