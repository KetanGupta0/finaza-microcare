<?php

namespace Tests\Feature;

use App\Enums\LeadStatus;
use App\Models\Lead;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LeadSubmissionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @param  array<string, mixed>  $overrides
     * @return array<string, mixed>
     */
    private function validPayload(array $overrides = []): array
    {
        return [
            'name' => 'Sunita Devi',
            'phone' => '+91 98765 43210',
            'email' => 'sunita@example.com',
            'city' => 'Patna',
            'service' => 'women-group-support',
            'message' => 'I run a small tailoring shop.',
            'consent' => '1',
            'website' => '',
            ...$overrides,
        ];
    }

    public function test_visitor_can_submit_an_enquiry(): void
    {
        $this->from('/contact')
            ->post('/enquiry', $this->validPayload())
            ->assertRedirect(url('/contact').'#enquiry')
            ->assertSessionHas('lead_submitted');

        $lead = Lead::sole();
        $this->assertSame('Sunita Devi', $lead->name);
        $this->assertSame('9876543210', $lead->phone);
        $this->assertSame('women-group-support', $lead->service);
        $this->assertSame('/contact', $lead->source_page);
        $this->assertSame(LeadStatus::New, $lead->status);
    }

    public function test_enquiry_requires_name_valid_mobile_and_consent(): void
    {
        $this->from('/contact')
            ->post('/enquiry', $this->validPayload(['name' => '', 'phone' => '12345', 'consent' => null]))
            ->assertRedirect('/contact')
            ->assertSessionHasErrors(['name', 'phone', 'consent']);

        $this->assertDatabaseCount('leads', 0);
    }

    public function test_enquiry_rejects_unknown_service(): void
    {
        $this->post('/enquiry', $this->validPayload(['service' => 'crypto-trading']))
            ->assertSessionHasErrors('service');

        $this->assertDatabaseCount('leads', 0);
    }

    public function test_enquiry_with_filled_honeypot_is_rejected(): void
    {
        $this->post('/enquiry', $this->validPayload(['website' => 'http://spam.example']))
            ->assertSessionHasErrors('website');

        $this->assertDatabaseCount('leads', 0);
    }

    public function test_enquiry_submissions_are_rate_limited(): void
    {
        foreach (range(1, 5) as $attempt) {
            $this->post('/enquiry', $this->validPayload())->assertRedirect();
        }

        $this->post('/enquiry', $this->validPayload())->assertTooManyRequests();
        $this->assertDatabaseCount('leads', 5);
    }
}
