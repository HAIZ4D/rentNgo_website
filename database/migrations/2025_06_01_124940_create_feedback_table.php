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
        Schema::create('feedback', function (Blueprint $table) {
    $table->id('feedbackID');
    $table->text('comment');
    $table->integer('rating');
    $table->date('dateSubmitted');
    $table->unsignedBigInteger('customerID');
    $table->timestamps();

    $table->foreign('customerID')->references('customerID')->on('customers')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
