<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Collection\Collection;

/**
 * Сущность статьи.
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $excerpt
 * @property string $content
 * @property string $thumbnail
 * @property string $cover_image
 * @property int $likes_count
 * @property int $views_count
 * @property DateTime $published_at
 * @property DateTime $created_at
 * @property DateTime $updated_at
 * @property Collection<Comment> $comments
 * @property Collection<Tag> $tags
 */
class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'thumbnail',
        'cover_image',
        'likes_count',
        'views_count',
        'published_at',
        'created_at',
        'updated_at',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
