<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PublicSurpriseController extends Controller
{
    public function show(string $slug)
    {
        $page = Page::where('slug', $slug)->with(['photos', 'audio'])->firstOrFail();

        return view('pages.surprise', [
            'page' => $page,
        ]);
    }
}
