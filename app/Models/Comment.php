<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Комментарий.
 *
 * @property int $article_id
 * @property string $subject
 * @property string $body
 * @property Article $article
 */
class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
      'article_id',
      'subject',
      'body',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
