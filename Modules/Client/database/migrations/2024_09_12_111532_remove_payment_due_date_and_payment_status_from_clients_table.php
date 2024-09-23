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
            // Remove the columns from the clients table
            $table->dropColumn('payment_status');
            $table->dropColumn('payment_due_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            // Add the columns back if you need to roll back the migration
            $table->string('payment_status')->nullable();
            $table->date('payment_due_date')->nullable();
        });
    }
};
