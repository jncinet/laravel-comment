<?php

namespace Jncinet\LaravelComment\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Jncinet\LaravelComment\Events\CreatedComment;
use Jncinet\LaravelComment\Events\DeletedComment;

class Comment extends Model
{
    protected $guarded = [];

    protected $dispatchesEvents = [
        'created' => CreatedComment::class,
        'deleted' => DeletedComment::class,
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->table = config('comment.comment_table');

        parent::__construct($attributes);
    }

    /**
     * 关联内容
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * 发布评论的会员
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(
            config('comment.user_information_model'),
            'user_id'
        );
    }

    /**
     * 回复列表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $type
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithType(Builder $query, $type)
    {
        return $query->where('commentable_type', app($type)->getMorphClass());
    }
}