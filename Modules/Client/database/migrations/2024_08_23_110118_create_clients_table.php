<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->enum('facility_level', ['HCI', 'HCII', 'HCIII', 'HCIV', 'Referral Hospital', 'Clinic', 'Hospital']);
            $table->string('location');
            $table->string('contact_person_name');
            $table->string('contact_person_phone');
            $table->string('email');
            $table->string('support_engineer_name');
            $table->string('support_engineer_phone');
            $table->string('support_engineer_email');
            $table->integer('billing_cycle_years');
            $table->decimal('amount', 10, 2); 
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes(); // Add this line for soft deletes
            $table->timestamps();
            
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
