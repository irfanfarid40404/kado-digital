<?php

namespace Tests\Feature;

use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicSurprisePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_paid_public_surprise_page_renders_successfully(): void
    {
        $page = Page::create([
            'theme' => 'romantic_classic',
            'recipient_name' => 'Nadia',
            'title' => 'Special For Nadia',
            'story' => 'Surat kenangan terindah untukmu.',
            'slug' => 'untuk-nadia-test123',
            'status' => 'paid',
            'package' => 'premium',
        ]);

        $response = $this->get('/s/untuk-nadia-test123');
        $response->assertStatus(200);
        $response->assertSee('Special For Nadia');
        $response->assertSee('Nadia');
        $response->assertSee('Surat kenangan terindah untukmu.');
    }
}
