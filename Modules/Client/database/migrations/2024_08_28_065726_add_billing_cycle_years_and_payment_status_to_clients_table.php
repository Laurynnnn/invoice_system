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
        Schema::table('clients', function (Blueprint $table) {
            $table->enum('billing_cycle_years', ['1 year', '2 years', '5 years'])->change();
            $table->enum('payment_status', ['paid', 'unpaid'])->after('billing_cycle_years')->default('unpaid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            // Revert the billing_cycle_years column back to its original type (integer)
            $table->integer('billing_cycle_years')->change();
            
            // Remove the payment_status column
            $table->dropColumn('payment_status');
        });
    }
};
