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
            $table->string('projectID');
            $table->string('assortment');
            $table->string('productID');
            $table->string('toyName');
            $table->string('category');
            $table->string('description');
            $table->string('designer');
            $table->string('pe');
            $table->string('meeting')->nullable();
            $table->string('start_date');
            $table->integer('month');
            $table->date('finish_cmt');
            $table->date('finish_act')->nullable();
            $table->integer('adherence')->nullable();
            $table->string('status');
            $table->string('remarks');
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
