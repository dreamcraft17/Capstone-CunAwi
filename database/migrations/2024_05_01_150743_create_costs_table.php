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
            $table->id();
            $table->integer('projectID');
            $table->string('assortment')->nullable();;
            $table->string('productID')->nullable();;
            $table->string('category')->nullable();;
            $table->string('material')->nullable();
            $table->integer('cost')->nullable();
            $table->integer('labor')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('total')->nullable();
            $table->string('remarks')->nullable();;
            $table->date('launch_avail')->nullable();
            $table->string('delay_reason')->nullable();
            $table->double('lead_time')->nullable();
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
