<?php

namespace Jncinet\LaravelComment\Traits;

trait Commentable
{
    /**
     * @return mixed
     */
    public function comments()
    {
        return $this->morphMany(config('comment.comment_model'), 'commentable');
    }
}