<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Render the XML sitemap of the public pages.
     */
    public function __invoke(): Response
    {
        $pages = [
            ['url' => route('home'), 'priority' => '1.0', 'changefreq' => 'weekly'],
            ['url' => route('services'), 'priority' => '0.9', 'changefreq' => 'monthly'],
            ['url' => route('about'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => route('contact'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => route('privacy'), 'priority' => '0.3', 'changefreq' => 'yearly'],
            ['url' => route('terms'), 'priority' => '0.3', 'changefreq' => 'yearly'],
        ];

        return response()
            ->view('sitemap', ['pages' => $pages, 'lastModified' => now()->startOfMonth()->toDateString()])
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
