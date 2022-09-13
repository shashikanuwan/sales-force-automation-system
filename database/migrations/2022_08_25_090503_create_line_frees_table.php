<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('line_frees', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('type');
            $table->integer('purchase_quantity');
            $table->integer('free_quantity');
            $table->integer('lower_limit');
            $table->integer('uper_limit');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('line_frees');
    }
};
