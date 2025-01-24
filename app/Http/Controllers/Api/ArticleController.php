<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use Illuminate\Support\Facades\Redis;

class ArticleController extends Controller
{
    public function __construct(
       protected ArticleService $articleService
    ) {
    }

    public function incrementLikes($articleId)
    {
        $newLikesCount = $this->articleService->incrementLikes($articleId);

        return response()->json(['likes_count' => $newLikesCount]);
    }

    public function incrementViews($articleId)
    {
        $newViewsCount = $this->articleService->incrementViews($articleId);

        return response()->json(['views_count' => $newViewsCount]);
    }
}
