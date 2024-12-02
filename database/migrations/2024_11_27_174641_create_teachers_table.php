<?php

use App\Models\AcademicYear;
use App\Models\Country;
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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AcademicYear::class)->references('id')->on('academic_years');
            $table->uuid('uuid');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->string('cni_number')->unique();
            $table->string('speciality');
            $table->date('hire_date');
            $table->date('date_of_first_appointment');
            $table->date('date_of_birth');
            $table->foreignIdFor(Country::class, 'place_of_birth_id')->references('id')->on('countries');
            $table->foreignIdFor(Country::class, 'nationality_id')->references('id')->on('countries');
            $table->unsignedBigInteger('current_salary');
            $table->boolean('status')->default(true);
            $table->string('profile-picture')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
