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
       Schema::create('cars', function (Blueprint $table) {
        $table->id('carID'); // Primary Key
        $table->unsignedBigInteger('adminID');

        $table->string('carName');
        $table->string('carModel');
        $table->string('carImage')->nullable(); // Assuming it's a file path or URL
        $table->integer('carSeat');
        $table->integer('carMileage');
        $table->string('plateNumber');
        $table->double('pricePerDay', 8, 2);
        $table->string('transmissionType');
        $table->string('location');
        $table->date('availableFrom')->nullable();
        $table->date('availableTo')->nullable();
        $table->string('fuelType');
        $table->string('carType')->nullable(); // e.g., SUV, Sedan
        $table->enum('availabilityStatus', ['Available', 'Unavailable'])->default('Available');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
