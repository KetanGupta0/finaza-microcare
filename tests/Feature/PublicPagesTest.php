<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    /**
     * @return array<string, array{string, string}>
     */
    public static function pages(): array
    {
        return [
            'home' => ['/', 'Stronger livelihoods'],
            'about' => ['/about', 'Registered and verifiable'],
            'services' => ['/services', 'Women Group Support'],
            'contact' => ['/contact', 'Tell us how we can help'],
            'privacy' => ['/privacy-policy', 'Privacy Policy'],
            'terms' => ['/terms', 'Terms of Use'],
        ];
    }

    #[DataProvider('pages')]
    public function test_public_page_renders_with_seo_tags_and_contact_details(string $uri, string $expectedText): void
    {
        $this->get($uri)
            ->assertOk()
            ->assertSee($expectedText)
            ->assertSee('<link rel="canonical" href="'.url($uri === '/' ? '' : $uri).'">', false)
            ->assertSee('<meta name="description"', false)
            ->assertSee('application/ld+json', false)
            ->assertSee('U65100BR2022NPL057169')
            ->assertSee('tel:+918009877918', false)
            ->assertSee('https://wa.me/918009877918', false);
    }

    public function test_about_page_lists_registered_company_details(): void
    {
        $this->get('/about')
            ->assertOk()
            ->assertSee('Finaza Micro Care Federation of India')
            ->assertSee('30 March 2022')
            ->assertSee('Registrar of Companies, Patna');
    }

    public function test_home_page_includes_faq_structured_data(): void
    {
        $this->get('/')->assertSee('"@type":"FAQPage"', false);
    }

    public function test_sitemap_lists_public_pages_and_not_admin(): void
    {
        $response = $this->get('/sitemap.xml');

        $response->assertOk()
            ->assertHeader('Content-Type', 'application/xml; charset=UTF-8')
            ->assertSee('<loc>'.route('services').'</loc>', false)
            ->assertSee('<loc>'.route('contact').'</loc>', false)
            ->assertDontSee('/admin', false);
    }
}
