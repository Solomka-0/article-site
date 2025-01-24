<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->route()->getName() === 'home') {
            $articles = Article::latest()->take(6)->get();
            return inertia('Home', [
                'articles' => $articles,
            ]);
        } else {
            $articles = Article::latest()->paginate(10);
            return inertia('Articles/Index', [
                'articles' => $articles,
            ]);
        }
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)
            ->with('tags')
            ->firstOrFail();

        return inertia('Articles/Show', [
            'article' => $article,
        ]);
    }

    public function incrementLikes($id)
    {
        $article = Article::findOrFail($id);
        $article->increment('likes_count');

        return response()->json(['likes_count' => $article->likes_count]);
    }

    public function incrementViews($id)
    {
        $article = Article::findOrFail($id);
        $article->increment('views_count');

        return response()->json(['views_count' => $article->views_count]);
    }
}
