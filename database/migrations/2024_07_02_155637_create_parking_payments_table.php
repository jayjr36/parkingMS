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
           $table->string('card_number');
            $table->string('payment_fee');
            $table->string('time_spent');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('parking_payments');
    }
};
