<?php

use App\Models\AcademicYear;
use App\Models\Period;
use App\Models\Student;
use App\Models\Subject;
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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AcademicYear::class)->references('id')->on('academic_years');
            $table->foreignIdFor(Student::class)->references('id')->on('students')->cascadeOnDelete();
            $table->foreignIdFor(Subject::class)->references('id')->on('subjects')->cascadeOnDelete();
            $table->foreignIdFor(Period::class)->references('id')->on('periods')->cascadeOnDelete();
            $table->date('day');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
