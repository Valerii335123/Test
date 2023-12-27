<?php

namespace App\Models;

use App\Traits\ApproveTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property string|null $title
 * @property string $slug
 * @property int $is_approved
 * @property string|null $preview_text
 * @property string|null $text
 * @property string|null $image
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\PostFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereIsApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePreviewText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUserId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Comment> $Comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Comment> $comments
 * @method static \Illuminate\Database\Eloquent\Builder|Post ofApproved()
 * @method static \Illuminate\Database\Eloquent\Builder|Post ofBlocked()
 * @mixin \Eloquent
 */
class Post extends Model
{
    use HasFactory;
    use ApproveTrait;

    protected $fillable = [
        'title',
        'slug',
        'preview_text',
        'text',
        'image'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}