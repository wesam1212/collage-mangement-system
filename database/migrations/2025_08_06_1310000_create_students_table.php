<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->integer('age')->nullable();
    $table->enum('gender', ['Male', 'Female'])->nullable();
    $table->string('email')->unique();

    $table->foreignId('department_id')->constrained()->onDelete('cascade');
    $table->foreignId('course_id')->nullable()->constrained()->onDelete('cascade');
    $table->foreignId('doctor_id')->nullable()->constrained()->nullOnDelete();

    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
