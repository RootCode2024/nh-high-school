<?php

use App\Models\Period;
use App\Models\Student;
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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AcademicYear::class)->references('id')->on('academic_years');
            $table->foreignIdFor(Student::class)->references('id')->on('students');
            $table->foreignIdFor(Period::class)->references('id')->on('periods');
            $table->unsignedBigInteger('amount');
            $table->text('comment')->nullable();
            $table->enum('payment_mode', ['cash', 'wave', 'bank', 'OM'])->default('cash');
            $table->enum('payment_for', ['school_fees', 'registration_fees', 'bus_fees', 'other'])->default('school_fees');
            $table->date('date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
