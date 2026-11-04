<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

#[Signature('app:create-admin-user {email : Login email of the admin} {--name=Admin : Display name}')]
#[Description('Create an admin login for the leads panel (or reset the password of an existing one)')]
class CreateAdminUser extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $email = (string) $this->argument('email');
        $password = (string) $this->secret('Password (min 8 characters)');

        $validator = Validator::make(
            ['email' => $email, 'password' => $password],
            ['email' => ['required', 'email'], 'password' => ['required', 'string', 'min:8']],
        );

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return self::FAILURE;
        }

        $user = User::updateOrCreate(
            ['email' => $email],
            ['name' => (string) $this->option('name'), 'password' => $password],
        );

        $this->info(($user->wasRecentlyCreated ? 'Admin created: ' : 'Password updated for: ').$email);

        return self::SUCCESS;
    }
}
