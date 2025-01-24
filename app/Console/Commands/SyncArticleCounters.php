<?php

namespace App\Console\Commands;

use App\Models\Article;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

/**
 * Команда для синхронизации счетчиков с кэшированными записями
 */
class SyncArticleCounters extends Command
{
    protected $signature = 'sync:article-counters';
    protected $description = 'Синхронизация счётчиков статей из Redis с базой данных';

    public function handle()
    {
        $articleIds = Article::pluck('id');

        foreach ($articleIds as $articleId) {
            $likesKey = "article:{$articleId}:likes";
            $viewsKey = "article:{$articleId}:views";

            $likes = Redis::get($likesKey);
            $views = Redis::get($viewsKey);

            $article = Article::find($articleId);

            if ($article) {
                if ($likes !== null) {
                    $article->likes_count = $likes;
                }

                if ($views !== null) {
                    $article->views_count = $views;
                }

                $article->save();
            }
        }

        $this->info('Счётчики статей успешно синхронизированы.');
    }
}
