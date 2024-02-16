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
        Schema::create('supplier_lists', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // $table->string('recipe_name');

            $table->unsignedBigInteger('recipe_id');
            $table->foreign('recipe_id')->references('id')->on('recipe_categories');

            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brand_categories');

            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('supplier_categories');

            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id')->references('id')->on('unit_categories');

            $table->string('reorder_lvl');
            $table->string('volume');
            $table->string('price');
            $table->string('pick_up_or_delivery');
            $table->string('contact_number');
            $table->string('contact_person')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_lists');
    }
};
