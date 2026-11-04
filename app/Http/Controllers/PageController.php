<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        if (config('site.coming_soon') && Carbon::parse(config('site.launch_at'))->isFuture()) {
            return app(ComingSoonController::class)();
        }

        return view('pages.home');
    }

    public function about(): View
    {
        return view('pages.about');
    }

    public function services(): View
    {
        return view('pages.services');
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function privacy(): View
    {
        return view('pages.privacy');
    }

    public function terms(): View
    {
        return view('pages.terms');
    }
}
