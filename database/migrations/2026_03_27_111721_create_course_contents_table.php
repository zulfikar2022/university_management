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
        Schema::create('course_contents', function (Blueprint $table) {
            $table->id();
            // course_id, content, teaching_strategy, assessment_strategy, CLO_mapping
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->text('content');
            $table->text('teaching_strategy');
            $table->text('assessment_strategy');
            $table->text('CLO_mapping');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_contents');
    }
};
