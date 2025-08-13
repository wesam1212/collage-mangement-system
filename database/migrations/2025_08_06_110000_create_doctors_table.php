<?php

// database/migrations/2025_08_06_000000_create_doctors_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
{
    Schema::table('doctors', function (Blueprint $table) {
        $table->dropColumn('specialization');
    });
}

public function down(): void
{
    Schema::table('doctors', function (Blueprint $table) {
        $table->string('specialization')->nullable();
    });
}
};
