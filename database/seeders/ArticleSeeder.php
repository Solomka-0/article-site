<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::factory(50)->create()->each(function (Article $article) {
            $tags = Tag::inRandomOrder()->take(rand(1, 5))->pluck('id');
            $article->tags()->attach($tags);
        });
    }
}
