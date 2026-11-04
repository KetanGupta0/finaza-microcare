<?php

namespace Tests\Feature;

use App\Enums\LeadStatus;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminLeadsTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_admin_login(): void
    {
        $lead = Lead::factory()->create();

        $this->get('/admin/leads')->assertRedirect('/admin/login');
        $this->get("/admin/leads/{$lead->id}")->assertRedirect('/admin/login');
        $this->get('/admin/leads/export')->assertRedirect('/admin/login');
        $this->patch("/admin/leads/{$lead->id}", ['status' => 'closed'])->assertRedirect('/admin/login');
        $this->delete("/admin/leads/{$lead->id}")->assertRedirect('/admin/login');

        $this->assertSame(LeadStatus::New, $lead->fresh()->status);
    }

    public function test_admin_can_log_in_and_out(): void
    {
        $user = User::factory()->create(['email' => 'admin@example.com', 'password' => 'secret-pass']);

        $this->post('/admin/login', ['email' => 'admin@example.com', 'password' => 'wrong'])
            ->assertSessionHasErrors('email');
        $this->assertGuest();

        $this->post('/admin/login', ['email' => 'admin@example.com', 'password' => 'secret-pass'])
            ->assertRedirect('/admin/leads');
        $this->assertAuthenticatedAs($user);

        $this->post('/admin/logout')->assertRedirect('/admin/login');
        $this->assertGuest();
    }

    public function test_admin_sees_leads_table_with_stats(): void
    {
        Lead::factory()->create(['name' => 'Ramesh Kumar', 'phone' => '9123456780']);
        Lead::factory()->contacted()->create(['name' => 'Anita Kumari']);

        $this->actingAs(User::factory()->create())
            ->get('/admin/leads')
            ->assertOk()
            ->assertSee('Ramesh Kumar')
            ->assertSee('9123456780')
            ->assertSee('Anita Kumari')
            ->assertViewHas('stats', fn (array $stats) => $stats['total'] === 2 && $stats['new'] === 1);
    }

    public function test_admin_can_filter_leads_by_search_and_status(): void
    {
        Lead::factory()->create(['name' => 'Ramesh Kumar']);
        Lead::factory()->contacted()->create(['name' => 'Anita Kumari']);
        $admin = User::factory()->create();

        $this->actingAs($admin)->get('/admin/leads?search=Ramesh')
            ->assertSee('Ramesh Kumar')
            ->assertDontSee('Anita Kumari');

        $this->actingAs($admin)->get('/admin/leads?status=contacted')
            ->assertSee('Anita Kumari')
            ->assertDontSee('Ramesh Kumar');
    }

    public function test_admin_can_update_lead_status_and_notes(): void
    {
        $lead = Lead::factory()->create();

        $this->actingAs(User::factory()->create())
            ->patch("/admin/leads/{$lead->id}", ['status' => 'converted', 'notes' => 'Visited office, documents received.'])
            ->assertRedirect("/admin/leads/{$lead->id}");

        $lead->refresh();
        $this->assertSame(LeadStatus::Converted, $lead->status);
        $this->assertSame('Visited office, documents received.', $lead->notes);
    }

    public function test_lead_update_rejects_unknown_status(): void
    {
        $lead = Lead::factory()->create();

        $this->actingAs(User::factory()->create())
            ->patch("/admin/leads/{$lead->id}", ['status' => 'archived'])
            ->assertSessionHasErrors('status');

        $this->assertSame(LeadStatus::New, $lead->fresh()->status);
    }

    public function test_admin_can_delete_a_lead(): void
    {
        $lead = Lead::factory()->create();

        $this->actingAs(User::factory()->create())
            ->delete("/admin/leads/{$lead->id}")
            ->assertRedirect('/admin/leads');

        $this->assertModelMissing($lead);
    }

    public function test_admin_can_export_leads_as_csv_with_formula_values_escaped(): void
    {
        Lead::factory()->create(['name' => 'Ramesh Kumar', 'message' => '=HYPERLINK("http://evil")']);

        $response = $this->actingAs(User::factory()->create())->get('/admin/leads/export');

        $response->assertOk();
        $this->assertStringContainsString('text/csv', $response->headers->get('Content-Type'));
        $csv = $response->streamedContent();
        $this->assertStringContainsString('Ramesh Kumar', $csv);
        $this->assertStringContainsString("'=HYPERLINK", $csv);
    }

    public function test_admin_pages_are_not_indexed(): void
    {
        $this->get('/admin/login')->assertOk()->assertSee('noindex, nofollow', false);
    }
}
