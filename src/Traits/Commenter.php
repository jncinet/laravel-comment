<?php

namespace Jncinet\LaravelComment\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Commenter
{
    /**
     * 用户评论列表
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function comments()
    {
        return $this->hasMany(
            config('comment.comment_model'),
            'user_id',
            $this->getKeyName()
        );
    }

    /**
     * 获取指定模型的
     *
     * @param string $model
     * @return Builder
     */
    public function getCommentItems($model)
    {
        return app($model)->whereHas(
            'comments',
            function (Builder $query) {
                return $query->where('user_id', $this->getKey());
            }
        );
    }
}