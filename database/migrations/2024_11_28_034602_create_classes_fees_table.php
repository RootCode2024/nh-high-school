<?php

use App\Models\Classe;
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
        Schema::create('classes_fees', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AcademicYear::class)->references('id')->on('academic_years');
            $table->foreignIdFor(Classe::class)->references('id')->on('classes');
            $table->unsignedBigInteger('school_fee_amount');
            $table->unsignedBigInteger('transport_fee_amount');
            $table->unsignedBigInteger('registration_fee_amount');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes_fees');
    }
};
