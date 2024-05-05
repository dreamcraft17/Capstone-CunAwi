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
        Schema::create('cost', function (Blueprint $table) {
            // $table->id();
            $table->integer('projectID');
            $table->string('assortment');
            $table->string('productID');
            $table->string('category');
            $table->integer('material');
            $table->integer('cost');
            $table->integer('labor');
            $table->string('total');
            $table->string('remarks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cost');
    }
};
