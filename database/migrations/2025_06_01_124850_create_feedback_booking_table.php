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
        Schema::create('feedback_bookings', function (Blueprint $table) {
    $table->id('feedbackID');
    $table->text('comment');
    $table->integer('rating');
    $table->date('dateSubmitted');
    $table->unsignedBigInteger('bookingID');
    $table->date('date');
    $table->string('status');
    $table->decimal('totalAmount', 10, 2);
    $table->date('pickupDate');
    $table->date('returnDate');
    $table->string('pickupLocation');
    $table->string('dropOffLocation');
    $table->boolean('isLateReturn')->default(false);
    $table->decimal('lateFee', 10, 2)->default(0);
    $table->timestamps();

    $table->foreign('bookingID')->references('bookingID')->on('bookings')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback_booking');
    }
};
