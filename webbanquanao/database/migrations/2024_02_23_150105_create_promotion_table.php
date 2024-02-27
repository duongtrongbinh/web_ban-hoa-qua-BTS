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
        Schema::create('promotion', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->text('desc')->nullable();
            $table->bigInteger('quantity');
            $table->Integer('price_promotion');
            $table->boolean('freeship')->nullable()->default(false);
            $table->boolean('limited')->nullable()->default(false);
            $table->Integer('countProductUser')->nullable()->default(1);
            $table->softDeletes();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotion');
    }
};
