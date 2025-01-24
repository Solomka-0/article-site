<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ArticleStatsController extends Controller
{
    public function incrementLikes($articleId)
    {
        $newLikesCount = Redis::incr("article:{$articleId}:likes");

        return response()->json(['likes_count' => $newLikesCount]);
    }

    public function incrementViews($articleId)
    {
        // Атомарно увеличиваем счётчик просмотров в Redis
        $newViewsCount = Redis::incr("article:{$articleId}:views");

        return response()->json(['views_count' => $newViewsCount]);
    }
}
