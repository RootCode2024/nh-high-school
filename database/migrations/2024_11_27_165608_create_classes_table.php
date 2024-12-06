<?php

use App\Models\AcademicYear;
use App\Models\Building;
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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('level', ['Sixieme', 'Cinqieme', 'Quatrieme', 'Troisieme', 'Seconde', 'Première', 'Terminale'])->default('Sixieme');
            $table->foreignIdFor(Building::class)->references('id')->on('buildings');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
