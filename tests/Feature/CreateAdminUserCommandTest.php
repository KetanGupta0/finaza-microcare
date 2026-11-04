<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CreateAdminUserCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_command_creates_admin_user(): void
    {
        $this->artisan('app:create-admin-user', ['email' => 'owner@example.com', '--name' => 'Owner'])
            ->expectsQuestion('Password (min 8 characters)', 'strong-password')
            ->assertSuccessful();

        $user = User::where('email', 'owner@example.com')->sole();
        $this->assertSame('Owner', $user->name);
        $this->assertTrue(Hash::check('strong-password', $user->password));
    }

    public function test_command_rejects_short_password(): void
    {
        $this->artisan('app:create-admin-user', ['email' => 'owner@example.com'])
            ->expectsQuestion('Password (min 8 characters)', 'short')
            ->assertFailed();

        $this->assertDatabaseCount('users', 0);
    }
}
