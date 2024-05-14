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
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->string('projectID')->nullable();;
            $table->string('assortment')->nullable();;
            $table->string('productID')->nullable();;
            $table->string('toyName')->nullable();;
            $table->string('category')->nullable();;
            $table->string('description')->nullable();;
            $table->string('designer')->nullable();;
            $table->string('pe')->nullable();;
            $table->string('meeting')->nullable();
            $table->string('start_date')->nullable();;
            $table->integer('month')->nullable();;
            $table->date('finish_cmt')->nullable();;
            $table->date('finish_act')->nullable();
            $table->integer('adherence')->nullable();
            $table->string('status')->nullable();;
            $table->string('remarks')->nullable();;
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data');
    }
};
