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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['doctor'])->default('doctor');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('phone_number')->nullable();
            $table->string('address')->nullable();
            $table->enum('speciality', ['dentist', 'surgeon',
                                        'physician','gynecologist', 
                                        'pediatrician', 'orthopedic' ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
