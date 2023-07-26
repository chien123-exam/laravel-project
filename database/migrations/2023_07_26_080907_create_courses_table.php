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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('link');
            $table->decimal('price', $precision = 17, $scale = 2);
            $table->bigInteger('created_by')->length(20)->comment('Người tạo khoá học');
            $table->bigInteger('category_id')->length(20);
            $table->integer('lessions')->length(11)->comment('Tổng số bài học trong khoá học');
            $table->integer('view_count')->length(11)->comment('Tổng số lượt xem');
            $table->json('benefits');
            $table->json('fqa');
            $table->tinyInteger('is_feature')->length(1);
            $table->tinyInteger('is_online')->length(1);
            $table->text('description');
            $table->longText('content');
            $table->string('meta_title');
            $table->string('meta_desc');
            $table->string('meta_keyword');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
