<?php

namespace App\Jobs;

use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessComment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected int $articleId,
        protected array $data,
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Эмуляция долгой операции
        sleep(600);

        // Сохранение комментария
        $article = Article::find($this->articleId);

        if ($article) {
            $article->comments()->create([
                'subject' => $this->data['subject'],
                'body' => $this->data['body'],
            ]);
        }
    }
}
