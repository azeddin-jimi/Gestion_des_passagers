<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table): void {
            $table->string('payment_method', 80)->nullable()->after('seats_reserved');
            $table->string('discount_code', 50)->nullable()->after('payment_method');
            $table->boolean('newsletter_opt_in')->default(false)->after('discount_code');
            $table->boolean('terms_accepted')->default(false)->after('newsletter_opt_in');
        });
    }

    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table): void {
            $table->dropColumn(['payment_method', 'discount_code', 'newsletter_opt_in', 'terms_accepted']);
        });
    }
};
