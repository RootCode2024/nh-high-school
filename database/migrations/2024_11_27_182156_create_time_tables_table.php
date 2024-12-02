<?php

use App\Models\Classe;
use App\Models\Period;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\AcademicYear;
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
        Schema::create('time_tables', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AcademicYear::class)->references('id')->on('academic_years');
            $table->foreignIdFor(Classe::class)->references('id')->on('classes');
            $table->foreignIdFor(Subject::class)->references('id')->on('subjects');
            $table->foreignIdFor(Period::class)->references('id')->on('periods');
            $table->foreignIdFor(Teacher::class)->references('id')->on('teachers');
            $table->unsignedTinyInteger('coefficient')->default(1);
            $table->enum('day', ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']);
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_tables');
    }
};
