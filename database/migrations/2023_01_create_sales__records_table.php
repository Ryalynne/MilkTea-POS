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
        Schema::create('sales_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Or_id');
            $table->foreign('Or_id')->references('id')->on('o_r__lists');
            $table->string('Customer_Name');
            $table->string('Qty');
            $table->string('Product_id');
            $table->string('Sugar');
            $table->string('Add_on');
            // $table->string('Discount');
            $table->string('Cost_Price');
            $table->string('Unit_Price');
            $table->string('Profit');
            $table->string('Sub_Total');
            $table->string('Total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales__records');
    }
};
