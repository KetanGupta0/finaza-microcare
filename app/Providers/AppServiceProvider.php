<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::share('contact', $this->contactDetails());
    }

    /**
     * Phone, WhatsApp and map links used across the public pages.
     *
     * @return array{phone: string, phoneIntl: string, phoneDisplay: string, whatsappUrl: string, mapsUrl: string, mapsEmbedUrl: string}
     */
    private function contactDetails(): array
    {
        $countryCode = (string) config('site.country_code');
        $phone = preg_replace('/\D+/', '', (string) config('site.phone'));
        $whatsapp = preg_replace('/\D+/', '', (string) config('site.whatsapp'));
        $mapsQuery = urlencode((string) config('site.maps_query'));
        $greeting = rawurlencode('Hello Finaza Microcare, I would like to know more about your services.');

        return [
            'phone' => $phone,
            'phoneIntl' => $countryCode.$phone,
            'phoneDisplay' => $countryCode.' '.substr($phone, 0, 5).' '.substr($phone, 5),
            'whatsappUrl' => 'https://wa.me/'.ltrim($countryCode, '+').$whatsapp.'?text='.$greeting,
            'mapsUrl' => 'https://www.google.com/maps/search/?api=1&query='.$mapsQuery,
            'mapsEmbedUrl' => 'https://www.google.com/maps?q='.$mapsQuery.'&output=embed',
        ];
    }
}
