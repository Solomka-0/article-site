<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Jobs\ProcessComment;
use App\Repositories\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct(
        protected CommentService $commentService
    ) {
    }

    public function store(StoreCommentRequest $request, $articleId)
    {
        $this->commentService->storeComment($articleId, $request->validated());

        return response()->json(['message' => 'Комментарий обрабатывается']);
    }
}
