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
        Schema::create('items', function (Blueprint $table) { // Schema that automatically makes a table.
            $table->increments('item_id'); // PK
            $table->integer('category_id');
            $table->string('name')->unique(); // Force unique names.
            $table->string('description');
            $table->double('price');
            $table->integer('quantity');
            $table->string('sku')->unique(); // ... and SKUs.
            $table->string('picture_path'); // Store the image path instead of the image because why would you even do that.
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
