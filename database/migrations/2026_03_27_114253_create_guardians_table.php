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
        Schema::create('guardians', function (Blueprint $table) {
            $table->id();
            // student_id, father_name, father_phone, mother_name, mother_phone, father_nid, mother_nid, guardian_occupation, income_per_year
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('father_name')->nullable();
            $table->string('father_phone')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_phone')->nullable();
            $table->string('father_nid')->nullable();
            $table->string('mother_nid')->nullable();
            $table->string('guardian_occupation')->nullable();
            $table->decimal('income_per_year', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guardians');
    }
};
