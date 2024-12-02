<?php

use App\Models\Country;
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
        Schema::create('tutors', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->string('cni_number')->unique();
            $table->string('work')->nullable();
            $table->enum('type', ['father', 'mother', 'sister', 'brother', 'uncle', 'aunt', 'grand_father', 'grand_mother']);
            $table->date('date_of_birth');
            $table->foreignIdFor(Country::class, 'place_of_birth_id')->references('id')->on('countries');
            $table->foreignIdFor(Country::class, 'nationality_id')->references('id')->on('countries');
            $table->string('profile_picture')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutors');
    }
};
