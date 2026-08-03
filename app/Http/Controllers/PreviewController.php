<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PreviewController extends Controller
{
    public function show(Page $page)
    {
        // Load page media
        $page->load(['photos', 'audio']);

        return view('pages.preview', [
            'page' => $page,
        ]);
    }
}
