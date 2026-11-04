<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\View\View;

class ComingSoonController extends Controller
{
    public function __invoke(): View
    {
        $phone = preg_replace('/\D+/', '', (string) config('site.phone'));
        $phoneIntl = config('site.country_code').$phone;

        return view('coming-soon', [
            'launchAt' => Carbon::parse(config('site.launch_at'))->setTimezone(config('site.timezone')),
            'phone' => $phone,
            'phoneIntl' => $phoneIntl,
            'phoneDisplay' => config('site.country_code').' '.substr($phone, 0, 5).' '.substr($phone, 5),
            'mapsUrl' => 'https://www.google.com/maps/search/?api=1&query='.urlencode((string) config('site.maps_query')),
        ]);
    }
}
