<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderCompleteController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PreviewController;
use App\Http\Controllers\PublicSurpriseController;
use App\Livewire\PageEditor;
use Illuminate\Support\Facades\Route;

// Landing Page
Route::get('/', function () {
    return view('landing');
})->name('landing');

// Multi-step Editor (Livewire)
Route::get('/create/{theme}', PageEditor::class)->name('create.theme');

// Watermarked Preview Page
Route::get('/preview/{page}', [PreviewController::class, 'show'])->name('preview');

// Checkout & Package Selection
Route::get('/checkout/{page}', [CheckoutController::class, 'show'])->name('checkout');
Route::post('/checkout/{page}', [CheckoutController::class, 'process'])->name('checkout.process');

// Dummy Payment Gateway Simulator
Route::get('/payment/{order}', [PaymentController::class, 'show'])->name('payment.show');
Route::post('/payment/{order}/simulate', [PaymentController::class, 'simulate'])->name('payment.simulate');

// Complete Page (Link + QR Code + WhatsApp Share)
Route::get('/order/{order}/complete', [OrderCompleteController::class, 'show'])->name('order.complete');

// Public Surprise Page
Route::get('/s/{slug}', [PublicSurpriseController::class, 'show'])->name('surprise.show');
