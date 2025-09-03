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
        Schema::table('users', function (Blueprint $table) {
            $table->string('type')->nullable()->after('email');
            $table->string('kvk_nummer')->nullable()->after('type');
            $table->string('bedrijfsnaam')->nullable()->after('kvk_nummer');
            $table->string('telefoon')->nullable()->after('bedrijfsnaam');
            $table->string('adres')->nullable()->after('telefoon');
            $table->string('postcode')->nullable()->after('adres');
            $table->string('plaats')->nullable()->after('postcode');
            $table->string('land')->nullable()->after('plaats');
            $table->string('btw_nummer')->nullable()->after('land');
            $table->string('iban')->nullable()->after('btw_nummer');
            $table->string('website')->nullable()->after('iban');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'type',
                'kvk_nummer',
                'bedrijfsnaam',
                'telefoon',
                'adres',
                'postcode',
                'plaats',
                'land',
                'btw_nummer',
                'iban',
                'website',
            ]);
        });
    }
};
