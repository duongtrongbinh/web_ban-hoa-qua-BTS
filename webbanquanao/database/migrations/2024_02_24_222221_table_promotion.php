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
        Schema::table('promotion',function (Blueprint $table){
            $table->smallInteger('discount_type')->comment('type_promotion');
            
        });

    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
