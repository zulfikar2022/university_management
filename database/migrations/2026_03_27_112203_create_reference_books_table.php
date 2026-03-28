<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reference_books', function (Blueprint $table) {
            $table->id();
            // course_id, SI_No, BookName, Author, File
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->string('SI_No');
            $table->string('BookName');
            $table->string('Author');
            $table->string('File')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reference_books');
    }
};
