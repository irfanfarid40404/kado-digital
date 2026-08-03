<?php

namespace Tests\Feature;

use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageCreationTest extends TestCase
{
    use RefreshDatabase;

    public function test_landing_page_renders_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Surprise');
        $response->assertSee('Romantis Klasik');
        $response->assertSee('Playful & Ceria');
        $response->assertSee('Elegan Malam');
    }

    public function test_editor_page_loads_for_theme(): void
    {
        $response = $this->get('/create/romantic_classic');
        $response->assertStatus(200);
        $response->assertSee('Nama Pasanganmu');
    }

    public function test_page_can_be_created_in_database(): void
    {
        $page = Page::create([
            'theme' => 'romantic_classic',
            'recipient_name' => 'Nadia',
            'title' => 'Selamat Ulang Tahun Nadia!',
            'story' => 'Terima kasih telah hadir dalam hidupku.',
            'status' => 'draft',
        ]);

        $this->assertDatabaseHas('pages', [
            'id' => $page->id,
            'recipient_name' => 'Nadia',
            'status' => 'draft',
        ]);
    }
}
