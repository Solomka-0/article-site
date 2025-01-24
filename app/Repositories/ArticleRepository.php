<?php

namespace App\Repositories;

use App\Models\Article;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Репозиторий статьи
 */
class ArticleRepository
{
    /**
     * Получить последние статьи для главной страницы.
     *
     * @param int $limit
     * @return Collection
     */
    public function getLatestArticles(int $limit = 6): Collection
    {
        return Article::latest()->take($limit)->get();
    }

    /**
     * Получить список статей с пагинацией.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function paginateArticles(int $perPage = 12): LengthAwarePaginator
    {
        return Article::latest()->paginate($perPage);
    }

    /**
     * Найти статью по slug с тегами.
     *
     * @param string $slug
     * @return Article|null
     */
    public function findArticleBySlug(string $slug): ?Article
    {
        return Article::where('slug', $slug)
            ->with('tags')
            ->first();
    }

    /**
     * Найти статью по идентификатору.
     *
     * @param int $id
     * @return Article|null
     */
    public function findArticleById(int $id): ?Article
    {
        return Article::find($id);
    }

    /**
     * Увеличить счетчик лайков статьи.
     *
     * @param Article $article
     * @return bool
     */
    public function incrementLikes(Article $article): bool
    {
        return $article->increment('likes_count');
    }

    /**
     * Увеличить счетчик просмотров статьи.
     *
     * @param Article $article
     * @return bool
     */
    public function incrementViews(Article $article): bool
    {
        return $article->increment('views_count');
    }
}
