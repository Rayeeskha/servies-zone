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
        Schema::create('service_activation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('electrician_id')->constrained('users')->nullable();
            $table->string('payment_amount')->nullable();
            $table->string('due_amount')->nullable();
            $table->string('number_of_leads')->nullable();
            $table->string('payment_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_activation');
    }
};
