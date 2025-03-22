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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('content');
            $table->integer('view');
            $table->timestamps();
        });

     
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Xóa khóa ngoại trước khi xóa bảng
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['id_categori_post']); // Xóa khóa ngoại
            $table->dropColumn('id_categori_post'); // Xóa cột
        });

        Schema::dropIfExists('posts');
    }
};

