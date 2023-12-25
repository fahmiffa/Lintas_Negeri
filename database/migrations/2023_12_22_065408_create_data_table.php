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
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->string('users_id');
            $table->string('alamat')->nullable();
            $table->string('gender')->nullable();
            $table->string('place_birth')->nullable();
            $table->date('date_birth')->nullable();               
            $table->string('religion')->nullable();
            $table->integer('married')->nullable();
            $table->string('tall')->nullable();
            $table->string('weight')->nullable();
            $table->string('blood')->nullable();
            $table->string('hobbies')->nullable();  
            $table->text('dad')->nullable();
            $table->text('mom')->nullable();
            $table->text('bro')->nullable();
            $table->text('sis')->nullable();
            $table->text('study')->nullable();
            $table->text('job')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data');
    }
};
