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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('courseCode')->unique();
            $table->string('courseTitle');
            $table->foreignId('department_id')->constrained()->onDelete('cascade');
            $table->foreignId('degree_id')->constrained()->onDelete('cascade');
            $table->double('credit');
            $table->double('contactHourPerWeek');
            $table->string('level');
            $table->string('semester');
            $table->string('academicSession');
            $table->string('type');
            $table->string('type_T_S');

            $table->double('totalMarks')->nullable();
            $table->string('instructor')->nullable();
            $table->text('prerequisite')->nullable();
            $table->text('summary')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
