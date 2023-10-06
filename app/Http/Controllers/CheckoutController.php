<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkout;

class CheckoutController extends Controller
{
    public function index() {
        $checkoutItems = Checkout::all();
        return response()->json($checkoutItems);
    }

    public function store(Request $request) {
        $request->validate([
            "name" => "required",
            "email" => "required",
            "phone" => "required",
            "address" => "required",
            "region" => "required",
            "total" => "required"
        ]);
        $checkoutItems = Checkout::create($request->all());
        return response()->json($checkoutItems);
    }
}
