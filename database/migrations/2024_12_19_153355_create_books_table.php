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

        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('id_isbn')->unique();
            $table->string('isbn');
            $table->string('title');
            $table->string('genre');
            $table->string('publisher');
            $table->foreignId('author_id')->constrained('authors');
            $table->string('cover_url')->default('profile-photos/noimage.png')->nullable();
            $table->string('status')->default('Disponible');
            $table->integer('location_floor')->default(0);
            $table->integer('location_aisle')->default(0);
            $table->integer('location_bookshelves')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authors');
        Schema::dropIfExists('books');
    }
};
