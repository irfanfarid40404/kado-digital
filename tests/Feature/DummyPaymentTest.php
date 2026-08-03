<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DummyPaymentTest extends TestCase
{
    use RefreshDatabase;

    public function test_checkout_creates_pending_order(): void
    {
        $page = Page::create([
            'theme' => 'romantic_classic',
            'recipient_name' => 'Nadia',
            'title' => 'Happy Anniversary!',
            'story' => 'Cerita romantis kita...',
            'status' => 'draft',
        ]);

        $response = $this->post("/checkout/{$page->id}", [
            'package' => 'premium',
        ]);

        $this->assertDatabaseHas('orders', [
            'page_id' => $page->id,
            'package' => 'premium',
            'amount' => 35000,
            'status' => 'pending',
        ]);

        $order = Order::where('page_id', $page->id)->first();
        $response->assertRedirect(route('payment.show', ['order' => $order->id]));
    }

    public function test_dummy_payment_success_generates_slug_and_qr(): void
    {
        $page = Page::create([
            'theme' => 'romantic_classic',
            'recipient_name' => 'Nadia',
            'title' => 'Happy Anniversary!',
            'story' => 'Cerita romantis kita...',
            'status' => 'pending_payment',
        ]);

        $order = Order::create([
            'page_id' => $page->id,
            'amount' => 35000,
            'package' => 'premium',
            'payment_method' => 'qris',
            'status' => 'pending',
            'dummy_reference_code' => 'TEST-REF-123',
        ]);

        $response = $this->post("/payment/{$order->id}/simulate", [
            'result' => 'success',
        ]);

        $response->assertRedirect(route('order.complete', ['order' => $order->id]));

        $order->refresh();
        $page->refresh();

        $this->assertEquals('paid', $order->status);
        $this->assertEquals('paid', $page->status);
        $this->assertNotNull($page->slug);
        $this->assertStringContainsString('untuk-nadia', $page->slug);
        $this->assertDatabaseHas('qr_codes', [
            'page_id' => $page->id,
        ]);
    }
}
