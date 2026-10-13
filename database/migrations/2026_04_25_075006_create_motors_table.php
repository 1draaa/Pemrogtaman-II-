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
        Schema::create('motors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('brand'); // Honda, Yamaha, Ducati, etc.
            $table->enum('type', ['Moge', 'Matic', 'Sport', 'Cub', 'Adventure', 'Cruiser']);
            $table->integer('year');
            $table->bigInteger('price');
            $table->integer('odometer');
            $table->string('tax_status'); // Hidup, Mati, etc.
            $table->enum('grade', ['A', 'B', 'C']); // Kondisi fisik/mesin
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->string('tag')->nullable(); // Terlaris, Baru Masuk, etc.
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motors');
    }
};
