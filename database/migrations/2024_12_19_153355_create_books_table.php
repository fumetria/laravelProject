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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('id_isbn')->unique();
            $table->string('isbn');
            $table->string('title');
            $table->string('genre');
            $table->string('publisher');
            $table->string('author_id')->constrained('authors');
            $table->string('status')->default('Disponible');
            $table->string('cover');
            $table->integer('floor')->default(0);
            $table->integer('aisle')->default(0);
            $table->integer('bookshelves')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
