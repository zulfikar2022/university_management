<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email_verified_at');
            $table->string('username')->after('phone')->default('user_' . Str::random(8));
            $table->string('profile_image')->nullable()->after('password');
            // dob, nationality, nid_no, blood_group (it will be an enum containing all of the possible blood groups)
            $table->date('dob')->nullable()->after('profile_image');
            $table->string('nationality')->nullable()->after('dob');
            $table->string('nid_no')->nullable()->after('nationality');
            $table->enum('blood_group', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])->nullable()->after('nid_no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'username', 'profile_image', 'dob', 'nationality', 'nid_no', 'blood_group']);
        });
    }
};
