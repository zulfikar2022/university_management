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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            // user_id and cascade null
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            //present_division, present_district, present_upazila, present_area, parmanent_division, permanent_district, permanent_upazila, permanent_area, permanent_district_distance (double)

            $table->string('present_division');
            $table->string('present_district');
            $table->string('present_upazila');
            $table->string('present_area');
            $table->string('permanent_division');
            $table->string('permanent_district');
            $table->string('permanent_upazila');
            $table->string('permanent_area');
            $table->double('permanent_district_distance')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
