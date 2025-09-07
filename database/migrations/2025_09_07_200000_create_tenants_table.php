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
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('identifier')->unique(); // Unique identifier instead of slug/domain
            $table->string('database_name');
            $table->string('database_host')->default('localhost');
            $table->string('database_port')->default('3306');
            $table->string('database_username');
            $table->string('database_password');
            $table->boolean('is_active')->default(true);
            $table->string('admin_email')->unique();
            $table->json('settings')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
