<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingCycleAmountsTable extends Migration
{
    public function up()
    {
        Schema::create('billing_cycle_amounts', function (Blueprint $table) {
            $table->id();
            $table->enum('billing_cycle_years', ['1 year', '2 years', '5 years']);
            $table->decimal('amount', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('billing_cycle_amounts');
    }
}
