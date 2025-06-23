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
    Schema::create('customers', function (Blueprint $table) {
    $table->id('customerID');
    $table->string('licenseNumber');
    $table->string('ICNumber');
    $table->integer('totalRental')->default(0);
    $table->string('address');
    $table->string('licenseStatus');
    $table->string('paymentMethods');
    $table->string('name');
    $table->string('password');
    $table->string('phoneNumber')->nullable(); // Add ->nullable()
    $table->string('emailAddress')->unique();
    $table->string('profilePhoto')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer');
    }
};
