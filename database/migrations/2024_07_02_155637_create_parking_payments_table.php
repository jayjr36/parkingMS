<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
       
        Schema::create('parking_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('car_plate_number', 10);
            $table->string('card_number', 16);
            $table->string('expiry_date', 7); // Assuming format MM/YYYY, varchar(7)
            $table->unsignedInteger('cvc');
            $table->unsignedInteger('amount');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('parking_payments');
    }
};
