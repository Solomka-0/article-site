<?php

namespace App\Services;

use App\Models\Article;
use App\Repositories\ArticleCacheRepository;
use App\Repositories\ArticleRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

/**
 * Сервис статьи.
 */
class ArticleService
{
    public function __construct(
        protected ArticleRepository $articleRepository,
        protected ArticleCacheRepository $articleCacheRepository,
    ) {
    }

    /**
     * Получить статьи для главной страницы.
     *
     * @return Collection
     */
    public function getHomeArticles(): Collection
    {
        return $this->articleRepository->getLatestArticles(6);
    }

    /**
     * Получить статьи для каталога с пагинацией.
     *
     * @return LengthAwarePaginator
     */
    public function getArticleList(): LengthAwarePaginator
    {
        return $this->articleRepository->paginateArticles(12);
    }

    /**
     * Получить статью для отображения.
     *
     * @param string $slug
     * @return Article
     * @throws ModelNotFoundException
     */
    public function getArticleBySlug(string $slug): Article
    {
        $article = $this->articleRepository->findArticleBySlug($slug);

        if (!$article) {
            abort(404);
        }

        return $article;
    }

    /**
     * Инкрементировать количество лайков статьи.
     *
     * @param int $articleId
     * @return int
     */
    public function incrementLikes(int $articleId): int
    {
        return $this->articleCacheRepository->incrementLikes($articleId);
    }

    /**
     * Инкрементировать количество просмотров статьи.
     *
     * @param int $articleId
     * @return int
     */
    public function incrementViews(int $articleId): int
    {
        return $this->articleCacheRepository->incrementViews($articleId);
    }
}
