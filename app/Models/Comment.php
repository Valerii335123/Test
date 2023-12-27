<?php

namespace App\Models;

use App\Traits\ApproveTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Comment
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property int $is_approved
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereIsApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUpdatedAt($value)
 * @property-read \App\Models\Post|null $post
 * @property int|null $post_id
 * @method static \Database\Factories\CommentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Comment ofApproved()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment ofBlocked()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment wherePostId($value)
 * @mixin \Eloquent
 */
class Comment extends Model
{
    use HasFactory;
    use  ApproveTrait;

    protected $fillable = [
        'name',
        'email'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

}