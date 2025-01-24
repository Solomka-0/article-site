<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Jobs\ProcessComment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, $articleId)
    {
        ProcessComment::dispatch($articleId, $request->validated());

        return response()->json(['message' => 'Комментарий обрабатывается']);
    }
}
