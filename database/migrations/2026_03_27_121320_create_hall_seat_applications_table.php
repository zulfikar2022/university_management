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
        Schema::create('hall_seat_applications', function (Blueprint $table) {
            $table->id();
            // student_id, application_date, status
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->date('application_date');
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hall_seat_applications');
    }
};
