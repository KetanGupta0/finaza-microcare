<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('phone', 15)->index();
            $table->string('email')->nullable();
            $table->string('city', 120)->nullable();
            $table->string('service', 60)->nullable()->index();
            $table->text('message')->nullable();
            $table->string('status', 20)->default('new')->index();
            $table->text('notes')->nullable();
            $table->string('source_page')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent', 500)->nullable();
            $table->timestamps();

            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
