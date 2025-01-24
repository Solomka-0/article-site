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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            $table->string('title')->index()->comment('Заголовок статьи');
            $table->string('slug')->index()->unique()->comment('URL-адрес статьи (должен быть уникальным)');
            $table->text('excerpt')->nullable()->comment('Краткое описание или превью');
            $table->longText('content')->comment('Полный текст статьи');
            $table->string('thumbnail')->nullable()->comment('Ссылка на миниатюру статьи');
            $table->string('cover_image')->nullable()->comment('Ссылка на обложку статьи');
            $table->unsignedBigInteger('likes_count')->default(0)->comment('Кол-во лайков');
            $table->unsignedBigInteger('views_count')->default(0)->comment('Кол-во просмотров');
            $table->timestamp('published_at')->index()->nullable()->comment('Дата и время публикации');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
