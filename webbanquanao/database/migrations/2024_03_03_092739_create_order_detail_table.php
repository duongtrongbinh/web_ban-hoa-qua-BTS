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
        Schema::create('order_detail', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('quantity');
            $table->Integer('price');
            $table->timestamps();
            $table->timestamp('created_by')->nullable();
            $table->timestamp('updated_by')->nullable();
            $table->softDeletes();
        });
        Schema::table('order_detail',function (Blueprint $table){
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('order_id')->constrained('order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_detail');
    }
};
