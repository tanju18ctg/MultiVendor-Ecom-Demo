<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('order_number')->nullable();
            $table->string('shipping_address');
            $table->string('payment_type',20)->default('cash');
            $table->float('subtotal',8,2);
            $table->float('discount',8,2)->nullable();
            $table->float('charges',8,2)->nullable()->default(0);
            $table->float('total',8,2);
            $table->enum('status',['pending','confirmed','delivered'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
