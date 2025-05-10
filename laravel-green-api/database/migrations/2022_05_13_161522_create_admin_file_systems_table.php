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
        Schema::create('admin_file_systems', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('admin_id')->nullable();
            $table->string('url');
            $table->enum('type',['product','category','brand','slider'])->default('product');
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
        Schema::dropIfExists('admin_file_systems');
    }
};
