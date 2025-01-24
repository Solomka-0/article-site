<?php

namespace App\Repositories;

use App\Jobs\ProcessComment;

class CommentService
{
    /**
     * Сохранить комментарий (отправить в очередь на обработку).
     *
     * @param int $articleId
     * @param array $data
     * @return void
     */
    public function storeComment(int $articleId, array $data): void
    {
        ProcessComment::dispatch($articleId, $data);
    }
}
