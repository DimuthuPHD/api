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
            $table->unsignedBigInteger('gender_id')->nullable()->default(null);
            $table->string('first_name');
            $table->string('last_name');
            $table->date('date_of_birth')->nullable()->default(null);
            $table->text('address')->nullable()->default(null);
            $table->string('telephone')->unique()->nullable()->default(null);
            $table->string('email')->unique();
            $table->unsignedBigInteger('job_type_id')->nullable()->default(null);
            $table->unsignedBigInteger('education_level_id')->nullable()->default(null);
            $table->text('work_experience')->nullable()->default(null);
            $table->text('notes')->nullable()->nullable()->default(null);
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
