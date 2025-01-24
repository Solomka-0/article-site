<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Redis;

class ArticleCacheRepository
{
    /**
     * Увеличить количество лайков статьи.
     *
     * @param int $articleId
     * @return int Новое количество лайков
     */
    public function incrementLikes(int $articleId): int
    {
        return Redis::incr("article:{$articleId}:likes");
    }

    /**
     * Увеличить количество просмотров статьи.
     *
     * @param int $articleId
     * @return int Новое количество просмотров
     */
    public function incrementViews(int $articleId): int
    {
        return Redis::incr("article:{$articleId}:views");
    }
}
