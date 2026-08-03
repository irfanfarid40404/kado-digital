<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Page;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function show(Page $page)
    {
        return view('pages.checkout', [
            'page' => $page,
        ]);
    }

    public function process(Request $request, Page $page)
    {
        $request->validate([
            'package' => 'required|in:basic,premium,exclusive',
        ]);

        $amounts = [
            'basic' => 15000,
            'premium' => 35000,
            'exclusive' => 75000,
        ];

        $package = $request->input('package');
        $amount = $amounts[$package];

        // Create or update order for this page
        $order = Order::updateOrCreate(
            ['page_id' => $page->id, 'status' => 'pending'],
            [
                'amount' => $amount,
                'package' => $package,
                'payment_method' => 'qris',
                'dummy_reference_code' => 'DUMMY-' . strtoupper(uniqid()),
            ]
        );

        $page->update([
            'package' => $package,
            'status' => 'pending_payment',
        ]);

        return redirect()->route('payment.show', ['order' => $order->id]);
    }
}
