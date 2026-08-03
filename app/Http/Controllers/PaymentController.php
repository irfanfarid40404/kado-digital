<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Page;
use App\Models\QrCode as QrCodeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    // DUMMY PAYMENT — replace with real Midtrans/Xendit integration before production
    public function show(Order $order)
    {
        $order->load('page');

        // Check if expired (15 minutes limit simulation)
        if ($order->status === 'pending' && $order->created_at->diffInMinutes(now()) >= 15) {
            $order->update(['status' => 'expired']);
            $order->page->update(['status' => 'expired']);
        }

        return view('pages.payment', [
            'order' => $order,
            'page' => $order->page,
        ]);
    }

    // DUMMY PAYMENT — replace with real Midtrans/Xendit integration before production
    public function simulate(Request $request, Order $order)
    {
        $result = $request->input('result', 'success');

        if ($result === 'success') {
            $page = $order->page;

            // Generate unique slug
            $baseSlug = 'untuk-' . Str::slug($page->recipient_name);
            $uniqueSlug = $baseSlug . '-' . Str::lower(Str::random(4));

            // Ensure slug uniqueness
            while (Page::where('slug', $uniqueSlug)->exists()) {
                $uniqueSlug = $baseSlug . '-' . Str::lower(Str::random(4));
            }

            // Update order and page
            $order->update([
                'status' => 'paid',
                'paid_at' => now(),
            ]);

            $page->update([
                'slug' => $uniqueSlug,
                'status' => 'paid',
            ]);

            // Generate QR Code pointing to /s/{slug}
            $targetUrl = route('surprise.show', ['slug' => $uniqueSlug]);
            $qrDirectory = 'qrcodes';
            if (!Storage::disk('public')->exists($qrDirectory)) {
                Storage::disk('public')->makeDirectory($qrDirectory);
            }

            $qrFileName = $qrDirectory . '/qr-' . $page->id . '-' . time() . '.svg';

            try {
                $qrContent = QrCode::size(300)->color(107, 31, 42)->margin(1)->generate($targetUrl);
                Storage::disk('public')->put($qrFileName, $qrContent);
            } catch (\Throwable $e) {
                // Fallback if SVG renderer fails: basic QR generator string
                $qrContent = QrCode::size(300)->generate($targetUrl);
                Storage::disk('public')->put($qrFileName, $qrContent);
            }

            QrCodeModel::updateOrCreate(
                ['page_id' => $page->id],
                ['file_path' => $qrFileName]
            );

            return redirect()->route('order.complete', ['order' => $order->id]);
        } else {
            $order->update([
                'status' => 'failed',
            ]);

            return redirect()->route('payment.show', ['order' => $order->id])
                ->with('error', 'Pembayaran gagal disimulasikan. Silakan coba lagi.');
        }
    }
}
