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
        Schema::create('lead_inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->BigInteger('phone')->nullable();
            $table->BigInteger('lead_service_id')->nullable();
            $table->BigInteger('country_id')->nullable();
            $table->BigInteger('state_id')->nullable();
            $table->BigInteger('city_id')->nullable();
            $table->string('location')->nullable();
            $table->string('assign_electrician_id')->nullable();
            $table->tinyInteger("status")->default(0)->comment("1 => Active, 2=> assign elect view,3 => perform elec, 4 => cancel by emp, 0 => cancel by elec");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_inquiries');
    }
};
