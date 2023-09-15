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
        Schema::create('registered_prescribers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prescriber_id');
            $table->string('name');
            $table->string('mail');
            $table->string('password');
            $table->timestamps();

            $table->foreign('prescriber_id')->references('id')->on('prescribers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registered_prescribers');
    }
};
