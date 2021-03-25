<?php

namespace Jncinet\LaravelComment\Events;

use Illuminate\Database\Eloquent\Model;

class Event
{
    /**
     * @var Model
     */
    public $comment;

    /**
     * Event constructor.
     * @param Model $comment
     */
    public function __construct(Model $comment)
    {
        $this->comment = $comment;
    }
}