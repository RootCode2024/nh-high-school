<?php

use App\Models\AcademicYear;
use App\Models\Bus;
use App\Models\Classe;
use App\Models\Club;
use App\Models\Country;
use App\Models\Tutor;
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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AcademicYear::class)->references('id')->on('academic_years');
            $table->uuid('uuid');
            $table->string('matricule')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('gender', ['male', 'female']);
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('address');
            $table->enum('blood_group', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])->nullable();
            $table->enum('religion', ['muslim', 'christian', 'other'])->nullable();
            $table->enum('scholarship', ['none', 'partial', 'full'])->default('none');
            $table->date('date_of_birth');
            $table->string('cni_number')->nullable();
            $table->boolean('status')->default(true);
            $table->string('profile_picture')->nullable();
            $table->string('assurance_number')->nullable();
            $table->boolean('enable_for_canteen')->default(false);
            $table->string('alergies')->nullable();
            $table->foreignIdFor(Country::class, 'place_of_birth_id')->references('id')->on('countries');
            $table->foreignIdFor(Country::class, 'nationality_id')->references('id')->on('countries');
            $table->foreignIdFor(Club::class)->references('id')->on('clubs');
            $table->foreignIdFor(Bus::class)->references('id')->on('buses');
            $table->foreignIdFor(Classe::class)->references('id')->on('classes');
            $table->foreignIdFor(Tutor::class)->references('id')->on('tutors');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
