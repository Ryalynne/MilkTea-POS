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
        Schema::create('product_tables', function (Blueprint $table) {
            $table->id();
            $table->string('Product_Name');
            $table->string('Image')->nullable();
            $table->string('Product_Cetegories');
            $table->string('Selling_Price');
            $table->string('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product__tables');
    }
};
