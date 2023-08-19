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
        Schema::create('job_seekers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gender_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('date_of_birth');
            $table->text('address');
            $table->string('telephone')->unique();
            $table->string('email')->unique();
            $table->unsignedBigInteger('job_type_id');
            $table->unsignedBigInteger('education_level_id');
            $table->text('work_experience');
            $table->text('notes')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('status');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_seekers');
    }
};
