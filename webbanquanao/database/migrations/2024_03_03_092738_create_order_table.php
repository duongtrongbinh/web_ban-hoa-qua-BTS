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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('phone');
            $table->string('address');
            $table->Integer('subtotal');
            $table->Integer('moneyship');
            $table->Integer('total');
            $table->smallInteger('status')->comment('OrderStatus')->index();
            $table->timestamp('end_date');
            $table->timestamps();
            $table->timestamp('created_by')->nullable();
            $table->timestamp('updated_by')->nullable();
            $table->softDeletes();
        });
        Schema::table('order',function (Blueprint $table){
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('payment_id')->constrained('payment_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
