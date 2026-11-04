<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_coming_soon_page_renders_with_contact_and_countdown(): void
    {
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
}
