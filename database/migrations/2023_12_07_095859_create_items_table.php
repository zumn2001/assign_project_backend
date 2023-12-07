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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');
            $table->string('owner_name');
            $table->integer('category_id');
            $table->string('phone');
            $table->integer('price');
            $table->string('address');
            $table->text('location')->nullable();
            $table->text('description');
            $table->string('item_condition');
            $table->string('item_type');
            $table->integer('image_id');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
