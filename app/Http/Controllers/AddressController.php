<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Customer;
use App\Http\Requests\AddressRequest;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddressRequest $request)
    {
        /* check customer data first */
        $payload = $request->all();
        $customer = Customer::find($payload['customer_id']);
        if (!$customer) {
            return response()->json([
                "success"   => false,
                "data"      => "Customer with id " . $payload['customer_id'] . " not found."
            ], 404);
        }

        /* insert address */
        $address = Address::create($request->validated());
        return response()->json([
            "success"   => true,
            "data"      => $address
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AddressRequest $request, string $id)
    {
        $address = Address::find($id);
        if (!$address) {
            return response()->json([
                "success"   => false,
                "message"   => "Address with id " . $id . " not Found"
            ], 404);
        }

        $address->update($request->validated());
        return response()->json([
            "success"   => true,
            "data"      => $address
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $address = Address::find($id);
        if (!$address) {
            return response()->json([
                "success"   => false,
                "message"   => "Address with id " . $id . " Not Found"
            ], 404);
        }

        $address->delete();
        return response()->json(null, 204);
    }
}
