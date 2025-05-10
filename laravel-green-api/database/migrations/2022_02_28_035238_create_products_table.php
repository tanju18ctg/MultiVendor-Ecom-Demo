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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('shop_id')->nullable();
            $table->unsignedBigInteger('seller_id')->nullable();
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->text('thumbnail')->nullable();
            $table->text('image')->nullable();
            $table->float('price',8,2)->default(0);
            $table->integer('discount')->default(0);
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->text('description')->nullable();
            $table->integer('stock')->default(0);
            $table->boolean('sale')->default(0);
            $table->enum('conditions',['new','popular','winter','feature'])->default('new');
            $table->enum('status',['active','inactive'])->default('inactive');
            $table->enum('added_by',['seller','admin'])->default('admin');
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
        Schema::dropIfExists('products');
    }
};
