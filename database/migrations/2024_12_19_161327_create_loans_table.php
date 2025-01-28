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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->dateTime('loan_start_date');
            $table->string('id_isbn');
            $table->foreign('id_isbn')->references('id_isbn')->on('books');
            $table->foreignId('user_id')->constrained('users');
            $table->dateTime('loan_end_date')->nullable();
            $table->dateTime('loan_due_date');
            $table->string('loan_status')->default('Activo');
            $table->foreignId('employee_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
