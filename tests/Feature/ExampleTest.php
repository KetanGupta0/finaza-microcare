<?php

namespace Tests\Feature;

use Illuminate\Support\Carbon;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_coming_soon_page_renders_with_contact_and_countdown_when_enabled(): void
    {
        config(['site.coming_soon' => true]);
        Carbon::setTestNow('2026-11-01 10:00:00');

        $this->get('/')
            ->assertOk()
            ->assertSee('Finaza Microcare')
            ->assertSee('tel:+918009877918', false)
            ->assertSee('https://wa.me/918009877918', false)
            ->assertSee('+91 80098 77918')
            ->assertSee('Parmeshwar Sadan')
            ->assertSee('data-launch-at="2026-11-08T00:00:00+05:30"', false)
            ->assertSee('Sunday, 8 November 2026');
    }

    public function test_full_website_is_shown_once_launch_time_has_passed(): void
    {
        config(['site.coming_soon' => true]);
        Carbon::setTestNow('2026-11-08 00:00:01', 'Asia/Kolkata');

        $this->get('/')
            ->assertOk()
            ->assertDontSee('data-launch-at', false)
            ->assertSee('Stronger livelihoods');
    }
}
