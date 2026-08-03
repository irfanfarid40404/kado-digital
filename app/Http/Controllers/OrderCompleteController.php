<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderCompleteController extends Controller
{
    public function show(Order $order)
    {
        $order->load(['page', 'page.qrCode']);

        if ($order->status !== 'paid') {
            return redirect()->route('payment.show', ['order' => $order->id]);
        }

        $page = $order->page;
        $publicUrl = route('surprise.show', ['slug' => $page->slug]);

        $waMessage = rawurlencode("Halo {$page->recipient_name}, ada kejutan manis yang kubuat khusus untukmu! Buka link ini ya: {$publicUrl} ❤️");
        $waShareUrl = "https://api.whatsapp.com/send?text={$waMessage}";

        return view('pages.complete', [
            'order' => $order,
            'page' => $page,
            'publicUrl' => $publicUrl,
            'waShareUrl' => $waShareUrl,
        ]);
    }
}
