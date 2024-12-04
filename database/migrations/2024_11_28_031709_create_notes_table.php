<?php

use App\Models\Student;
use App\Models\Subject;
use App\Models\AcademicYear;
use App\Models\Classe;
use App\Models\ExamType;
use App\Models\Period;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Student::class)->references('id')->on('students');
            $table->foreignIdFor(Classe::class)->references('id')->on('classes');
            $table->foreignIdFor(Subject::class)->references('id')->on('subjects');
            $table->foreignIdFor(AcademicYear::class)->references('id')->on('academic_years');
            $table->foreignIdFor(Period::class)->references('id')->on('periods');
            $table->foreignIdFor(ExamType::class)->references('id')->on('exam_types');
            $table->date('day');
            $table->decimal('note');
            $table->decimal('max_note')->default(20);
            $table->text('comment')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
