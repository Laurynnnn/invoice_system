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
            $table->unsignedBigInteger('billing_cycle_amount_id')->after('location');

            // Remove the old billing_cycle_years column
            $table->dropColumn('billing_cycle_years');

            // Add foreign key constraint
            $table->foreign('billing_cycle_amount_id')
                  ->references('id')
                  ->on('billing_cycle_amounts')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('', function (Blueprint $table) {
            // Re-add the billing_cycle_years column
            $table->enum('billing_cycle_years', ['1 year', '2 years', '5 years'])->after('email');

            // Remove the foreign key and drop the billing_cycle_amount_id column
            $table->dropForeign(['billing_cycle_amount_id']);
            $table->dropColumn('billing_cycle_amount_id');
        });
    }
};
