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
            $table->foreignId('id_isbn')->constrained('books');
            $table->foreign('id')->constrained(
                table: 'users',
                indexName: 'user_id'
            );
            $table->foreign('id')->constrained(
                table: 'users',
                indexName: 'employee_id'
            );
            $table->dateTime('loan_end_date');
            $table->dateTime('loan_due_date');
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
