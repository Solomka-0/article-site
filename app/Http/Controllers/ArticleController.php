<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Services\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct(
       protected ArticleService $articleService
    ) {
    }

    public function index(Request $request)
    {
        if ($request->route()->getName() === 'home') {
            $articles = $this->articleService->getHomeArticles();

            return inertia('Home', [
                'articles' => $articles,
            ]);
        } else {
            $articles = $this->articleService->getArticleList();

            return inertia('Articles/Index', [
                'articles' => $articles,
            ]);
        }
    }

    public function show($slug)
    {
        $article = $this->articleService->getArticleBySlug($slug);

        return inertia('Articles/Show', [
            'article' => $article,
        ]);
    }

    public function incrementLikes($id)
    {
        $likesCount = $this->articleService->incrementLikes($id);

        return response()->json(['likes_count' => $likesCount]);
    }

    public function incrementViews($id)
    {
        $viewsCount = $this->articleService->incrementViews($id);

        return response()->json(['views_count' => $viewsCount]);
    }
}
