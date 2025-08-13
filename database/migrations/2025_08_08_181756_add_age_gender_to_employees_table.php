<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('employees', function (Blueprint $table) {
        $table->integer('age')->nullable()->after('salary');
        $table->string('gender')->nullable()->after('age');
    });
}

public function down()
{
    Schema::table('employees', function (Blueprint $table) {
        $table->dropColumn(['age', 'gender']);
    });
}
};
