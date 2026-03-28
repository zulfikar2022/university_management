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
        Schema::create('course_learning_outcome_program_learning_outcome', function (Blueprint $table) {
            $table->id();
            // course_learning_outcome_id, program_learning_outcome_id
            $table->foreignId('course_learning_outcome_id')->constrained(null, null, 'clo_plo_clo_id_fk')->onDelete('cascade');
            $table->foreignId('program_learning_outcome_id')->constrained(null, null, 'clo_plo_plo_id_fk')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_learning_outcome_program_learning_outcome');
    }
};
