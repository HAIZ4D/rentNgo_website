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
       Schema::create('bookings', function (Blueprint $table) {
    $table->unsignedBigInteger('carID');
    $table->foreign('carID')->references('id')->on('cars')->onDelete('cascade');
    $table->id('bookingID');
    $table->date('date');
    $table->string('bookingStatus');
    $table->decimal('totalAmount', 10, 2);
    $table->date('pickupDate');
    $table->date('returnDate');
    $table->string('pickupLocation');
    $table->string('dropOffLocation');
    $table->boolean('isLateReturn')->default(false);
    $table->decimal('lateFee', 10, 2)->default(0);
    $table->unsignedBigInteger('adminID');
    $table->unsignedBigInteger('customerID');
    $table->timestamps();

    $table->foreign('adminID')->references('id')->on('admins')->onDelete('cascade');
    $table->foreign('customerID')->references('customerID')->on('customers')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};
