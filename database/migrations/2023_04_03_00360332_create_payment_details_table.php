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
        Schema::create('payment_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_activation_id')->constrained('service_activation')->nullable();
            $table->foreignId('electrician_id')->constrained('users')->nullable();
            $table->string('payment_amount')->nullable();            
            $table->string('number_of_leads')->nullable(); 
            $table->string('service_remarks')->nullable();                       
            $table->date('service_activation_date')->nullable();            
            $table->BigInteger('payment_by')->nullable();
            $table->BigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_details');
    }
};
