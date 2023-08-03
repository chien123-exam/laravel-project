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
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('type')->default(1)->comment('1: Normal user, 2: Admin user')->after('phone');
            $table->string('address')->nullable()->after('type');
            $table->string('avarta')->after('address');
            $table->tinyInteger('gender')->nullable()->comment('1: Male, 2: Famale')->after('avarta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['type', 'address', 'avarta', 'gender']);
        });
    }
};
