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
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->string('bus_number');
            $table->string('driver_fullname');
            $table->string('helper_fullname');

            $table->string('driver_phone')->unique();
            $table->string('helper_phone')->unique();

            $table->string('driver_cni_number')->unique();
            $table->string('helper_cni_number')->unique();

            $table->string('route');
            $table->unsignedSmallInteger('capacity');
            $table->enum('status', ['active', 'inactive']);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buses');
    }
};
